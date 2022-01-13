<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class Send_AdminController extends Controller
{
    public function showSendMethods(Request $request)
    {
        $files = Storage::files('public/emails');
        for ($i = 0; $i < count($files); $i++)
            $files[$i] = explode('/', $files[$i])[2];

        if ($request->session()->has('users'))
            return view('admin.send_methods', [
                'files' => $files,
                'users_count' => count($request->session()->get('users'))
            ]);
        return view('admin.send_methods', [
            'files' => $files
        ]);
    }

    public function send(Request $request)
    {
        dd($request->html_pattern);
        if ($request->user_method == 'choose' && count($request->session()->get('users')) == 0)
            throw \Illuminate\Validation\ValidationException::withMessages([
                'users' => 'Пользователи не выбраны'
            ]);
        if (!isset($request->html_pattern) && !isset($request->old_html))
            throw \Illuminate\Validation\ValidationException::withMessages([
                'html' => 'Выберите html шаблон'
            ]);
        if (!strpos($request->html_pattern, '.html'))
            throw \Illuminate\Validation\ValidationException::withMessages([
                'html' => 'Шаблон не является .html'
            ]);
        if (isset($request->old_html))
        {
            Mail::to($request->session()->has('users') ?
                        $session()->get('users') :
                        User::get())
                 ->send(new MailSender($request->old_html['name']));
            return redirect(route('admin-send_methods'));
        }

        $files = Storage::files('public/emails');
        dd($files);
        if (count($files) == 5)
            $this->deleteHtml($files[count($files)]);
        $path = $request->file($name)->store('img', 'public');

        //Mail::to($request->user())->send(new MailSender($request));
        return redirect(route('admin-send_methods'))->with('mistake', 'Ошибка');
    }
    public function deleteHtml($file)
    {
        Storage::delete('public/emails/'.$file);
        return redirect(route('admin-send_methods'));
    }
}

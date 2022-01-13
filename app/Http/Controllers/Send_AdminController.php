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
        $files = Storage::files('emails');
        for ($i = 0; $i < count($files); $i++)
            $files[$i] = explode('/', $files[$i])[1];

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
        if ($request->user_method == 'choose' && count($request->session()->get('users')) == 0)
            throw \Illuminate\Validation\ValidationException::withMessages([
                'users' => 'Пользователи не выбраны'
            ]);
        if (!isset($request->html_pattern) && !isset($request->old_html))
            throw \Illuminate\Validation\ValidationException::withMessages([
                'html' => 'Выберите html шаблон'
            ]);
        if (isset($request->old_html))
        {
            Mail::to($request->session()->has('users') ?
                        $session()->get('users') :
                        User::get())
                 ->send(new MailSender($request->old_html['name']));
            return redirect(route('admin-send_methods'));
        }

        $files = Storage::files('emails');
        if (count($files) == 5)
            $this->deleteHtml($files[4]);

        $path = Storage::putFileAs(
            'emails', $request->file('html_pattern'), $request->file('html_pattern')->getClientOriginalName()
        );
        Mail::to($request->session()->has('users') ?
            $session()->get('users') :
            User::get())
            ->send(new MailSender($request->file('html_pattern')->getClientOriginalName()));

        return redirect(route('admin-send_methods'));
    }
    public function deleteHtml($file)
    {
        Storage::delete('emails/'.$file);
        return redirect(route('admin-send_methods'));
    }
}

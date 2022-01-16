<?php

namespace App\Http\Controllers;

use App\Jobs\QueueSenderEmail;
use App\Mail\MailSender;
use App\Models\Job;
use App\Models\StatusJob;
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

        $status['count'] = StatusJob::sum('count_mails');
        $status['progress'] = 100 - (100 * count(Job::get()) / StatusJob::orderBy('date', 'desc')->first()->count_queue);
        return view('admin.send_methods', [
            'files' => $files,
            'status' => $status
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

        if (count(Job::get()) == 0)
            StatusJob::insert([
                'count_queue' => 1,
                'count_mails' => $request->session()->has('users') ?
                    count($request->session()->get('users')) :
                    count(User::get()),
            ]);
        else
        {
            StatusJob::orderBy('date', 'desc')
                ->limit(1)
                ->increment('count_queue');
            StatusJob::orderBy('date', 'desc')
                ->limit(1)
                ->increment('count_mails', $request->session()->has('users') ?
                    count($request->session()->get('users')) :
                    count(User::get()));
        }


        if (isset($request->old_html))
        {
            dispatch(new QueueSenderEmail($request->session()->has('users') ?
                        $request->session()->get('users') :
                        User::get(), $request->old_html['name']));
        }
        else
        {
            $files = Storage::files('emails');
            if (count($files) == 5)
                $this->deleteHtml($files[4]);

            Storage::putFileAs(
                'emails', $request->file('html_pattern'), $request->file('html_pattern')->getClientOriginalName()
            );

            dispatch(new QueueSenderEmail($request->session()->has('users') ?
                $request->session()->get('users') :
                User::get(), $request->file('html_pattern')->getClientOriginalName()));
        }

        $request->session()->flash('status', 'Emails успешно отправлены в обработку!');
        return redirect(route('admin-send_methods'));
    }
    public function deleteHtml($file)
    {
        Storage::delete('emails/'.$file);
        return redirect(route('admin-send_methods'));
    }
}

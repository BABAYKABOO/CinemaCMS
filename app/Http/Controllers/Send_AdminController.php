<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
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
        dd($request);

        //Mail::to($request->user())->send(new MailSender($request));
    }
    public function deleteHtml($file)
    {
        Storage::delete('public/emails/'.$file);
        return redirect(route('admin-send_methods'));
    }
}

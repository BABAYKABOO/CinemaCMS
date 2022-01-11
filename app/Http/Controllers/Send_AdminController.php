<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Send_AdminController extends Controller
{
    public function showSendMethods()
    {
        return view('admin.send_methods');
    }

    protected function send(Request $request)
    {


        //Mail::to($request->user())->send(new MailSender($request));
    }
}

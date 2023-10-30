<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class SendEmailController extends Controller
{
    //
    public function index()
    {
        {
            return view('emails.kirim-email');
            // $content = [
            //     'subject'   => 'This is the mail subject',
            //     'body'      => 'This is the email body of how
            //                      to send email from laravel 10 with mailtrap.'
            //     ];

            // Mail::to('rifaindrasetiawan@mail.ugm.ac.id')->send(new SendEmail($content));
            // return "Email berhasil dikirim.";
        }

    }
    public function store(Request $request)
    {
        $data = $request->all();

        dispatch(new SendMailJob($data));
            return redirect()->route('kirim-email')->with('status', 'Email berhasil dikirim');
    }
}

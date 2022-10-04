<?php

namespace App\Http\Controllers\Admin;

use App\Mail\Mailing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\MailFormRequest;

class MailsController extends Controller
{
  
    public function createmail() {

        return view('admin.mail.create-mail');
    }

    public function sendmail(MailFormRequest $request) {

        $details = $request->validated();
        Mail::to($details['to'])->send(new Mailing($details));
        return 'Email Sent';

    }
    
}

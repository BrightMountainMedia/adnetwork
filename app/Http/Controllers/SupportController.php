<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Http\Requests\SendSupportEmailRequest;

class SupportController extends Controller
{
    /**
     * Send a customer support request e-mail.
     *
     * @param  Request  $request
     * @return Response
     */
    public function sendEmail(SendSupportEmailRequest $request)
    {
        $data = $request->all();

        Mail::raw($data['message'], function ($m) use ($data) {
        	$m->to('support@brightmountainmedia.com')->subject('Support Request: '.$data['subject']);

            $m->replyTo($data['from']);
        });
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyAPIToken;
use App\Http\Requests\SendMailRequest;
use App\Jobs\SendMailJob;
use App\Services\SendMailService;

class SendMailController extends Controller
{
    /**
     * SendMailController constructor.
     */
    public function __construct()
    {
        $this->middleware(VerifyAPIToken::class);
    }

    /**
     * Validate the request and dispatch the send mail job.
     *
     * @param SendMailRequest $request
     */
    public function send(SendMailRequest $request)
    {
        $messages = $request->validated();

        dispatch(new SendMailJob($messages, new SendMailService()));
    }
}

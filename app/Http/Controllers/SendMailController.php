<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyAPIToken;
use App\Http\Requests\SendMailRequest;
use App\Jobs\SendMailJob;
use App\Services\SendMailService;

class SendMailController extends Controller
{
    /**
     * The instance of the mail sending service.
     *
     * @var SendMailService
     */
    private $service;

    /**
     * SendMailController constructor.
     *
     * @param SendMailService $service
     */
    public function __construct(SendMailService $service)
    {
        $this->middleware(VerifyAPIToken::class);

        $this->service = $service;
    }

    /**
     * Validate the request and dispatch the send mail job.
     *
     * @param SendMailRequest $request
     */
    public function send(SendMailRequest $request)
    {
        $messages = $request->validated();

        $this->service->send($messages);
    }
}

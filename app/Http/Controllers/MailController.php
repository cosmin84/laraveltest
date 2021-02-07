<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyAPIToken;
use App\Http\Requests\SendMailRequest;
use App\Services\MailService;

class MailController extends Controller
{
    /**
     * The instance of the mail sending service.
     *
     * @var MailService
     */
    private $service;

    /**
     * SendMailController constructor.
     *
     * @param MailService $service
     */
    public function __construct(MailService $service)
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

    public function list()
    {
        return $this->service->list();
    }
}

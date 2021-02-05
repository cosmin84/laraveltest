<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMailRequest;
use App\Services\SendMailService;

class SendMailController extends Controller
{
    /**
     * The instance of the service.
     *
     * @var SendMailService
     */
    protected $service;

    /**
     * SendMailController constructor.
     *
     * @param SendMailService $service
     */
    public function __construct(SendMailService $service)
    {
        $this->service = $service;
    }

    /**
     * Validate the request and send the e-mails.
     *
     * @param SendMailRequest $request
     */
    public function send(SendMailRequest $request)
    {
        $validated = $request->validated();

        $this->service->send($validated);
    }
}

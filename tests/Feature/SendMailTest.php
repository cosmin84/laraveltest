<?php

namespace Tests\Feature;

use App\Jobs\SendMailJob;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SendMailTest extends TestCase
{
    public function test_it_requires_api_token_to_perform_request()
    {
        $response = $this->postJson('/api/send', []);

        $response->assertStatus(403);
    }

    public function test_it_dispatches_the_job_when_valid_payload()
    {
        $this->withoutExceptionHandling();

        $messages = [
            'messages' => [
                [
                    'subject' => 'Plain text e-mail example',
                    'body' => 'Just a plain text message.',
                    'recipient' => 'one@example.com'
                ]
            ],
        ];

        Queue::fake();

        $response = $this->postJson('/api/send?api_token=123', $messages);

        $response->assertStatus(200);

        Queue::assertPushed(SendMailJob::class);
    }

    public function test_it_doesnt_dispatch_the_job_when_invalid_payload()
    {
        $messages = [
            'messages' => [
                [
                    'subject' => 'Plain text e-mail example',
                    'body' => 'Just a plain text message.',
                    'recipient' => ''
                ]
            ],
        ];

        Queue::fake();

        $response = $this->postJson('/api/send?api_token=123', $messages);

        $response->assertStatus(422);

        Queue::assertNotPushed(SendMailJob::class);
    }
}

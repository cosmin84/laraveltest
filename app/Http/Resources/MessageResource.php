<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'subject' => $this->subject,
            'recipient' => $this->recipient,
            'body' => $this->body,
            'attachments' => AttachmentResource::collection($this->attachments)
        ];
    }
}

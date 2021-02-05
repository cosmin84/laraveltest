<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'messages.*.subject' => ['required', 'string'],
            'messages.*.body' => ['required', 'string'],
            'messages.*.recipient' => ['required', 'email:filter'],
            'messages.*.attachments.*.encoded_content' => ['required_with:messages.*.attachments.*.filename'],
            'messages.*.attachments.*.filename' => ['required_with:messages.*.attachments.*.encoded_content']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'messages.*.subject.required' => 'The subject of the e-mail message is required.',
            'messages.*.body.required' => 'The body of the e-mail message is required.',
            'messages.*.recipient.required' => 'The e-mail address is required.',
            'messages.*.recipient.email' => 'The e-mail address provided must be a valid e-mail address.',
            'messages.*.attachments.*.encoded_content.required_with' => 'The base64 content of the attachment if required when the filename is provided.',
            'messages.*.attachments.*.filename.required_with' => 'The filename is required when the base64 content of the attachment is provided.'
        ];
    }
}

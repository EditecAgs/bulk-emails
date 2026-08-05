<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private string $emailSubject,
        private string $emailHtml,
        private array $emailData = []
    ) {}

    public function build()
    {
        $renderedHtml = $this->renderTemplate($this->emailHtml, $this->emailData);

        return $this->subject($this->emailSubject)  
                    ->html($renderedHtml);
    }

    private function renderTemplate(string $template, array $data): string
    {
        foreach ($data as $key => $value) {
            $template = preg_replace('/\{\{\s*' . preg_quote($key, '/') . '\s*\}\}/', $value, $template);
        }
        return $template;
    }
}
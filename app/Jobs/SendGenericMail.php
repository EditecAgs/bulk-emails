<?php

namespace App\Jobs;

use App\Mail\GenericMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class SendGenericMail implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly string $recipientEmail,
        private readonly string $recipientLabel,
        private readonly string $subject,      
        private readonly string $html,         
        private readonly array $data = []       
    ) {}

    public function handle(): void
    {
        try {
            Mail::to($this->recipientEmail)
                ->send(new GenericMail(
                    $this->subject,  
                    $this->html,
                    $this->data
                ));

            $this->appendLog('ok', 'Correo enviado correctamente');
        } catch (\Throwable $e) {
            $this->appendLog('error', $e->getMessage());
            throw $e;
        } finally {
            Cache::increment('mail_sent');
        }
    }

    private function appendLog(string $status, string $message): void
    {
        $log = Cache::get('mail_log', []);
        $log[] = [
            'username' => $this->recipientLabel,
            'status'   => $status,
            'message'  => $message,
        ];
        Cache::put('mail_log', $log);
    }
}
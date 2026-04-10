<?php

namespace App\Jobs;

use App\Mail\CredentialsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;


class SendMailUserMoodle implements ShouldQueue
{
    use Queueable;

    public array $alumno;

    /**
     * Create a new job instance.
     */
    public function __construct(array $alumno)
    {
         $this->alumno = $alumno;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->alumno['moodle'])->send(
                new CredentialsMail(
                    $this->alumno['firstname'].' '.$this->alumno['lastname'],
                    $this->alumno['email'],
                    $this->alumno['password'],
                    'https://login.microsoftonline.com/'
                )
            );
            Cache::increment('mail_sent');
            $log = Cache::get('mail_log', []);
            $log[] = [
                'username' => $this->alumno['username'],
                'status'   => 'ok',
                'message'  => 'Correo enviado correctamente'
            ];
            Cache::put('mail_log', $log);

        } catch (\Throwable $e) {

            Cache::increment('mail_sent');

            $log = Cache::get('mail_log', []);
            $log[] = [
                'username' => $this->alumno['username'],
                'status'   => 'error',
                'message'  => $e->getMessage()
            ];
            Cache::put('mail_log', $log);

            throw $e; // para que Laravel marque el job como FAIL
        }
    }
}

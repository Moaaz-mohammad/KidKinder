<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmninMassEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $bodyText;
    public $attachmentPath;

    public function __construct($subjectText, $bodyText, $attachmentPath = null)
    {
        $this->subjectText = $subjectText;
        $this->bodyText = $bodyText;
        $this->attachmentPath = $attachmentPath;
    }

    public function build()
    {
        $email = $this->subject($this->subjectText)
            ->view('emails.admin-mass')->with([
                'attachmentUrl' => $this->attachmentPath ? asset('storage/' . $this->attachmentPath) : null,
            ]);

        if ($this->attachmentPath) {
            $email->attach(storage_path('app/public/' . $this->attachmentPath));
        }

        return $email;
    }
}

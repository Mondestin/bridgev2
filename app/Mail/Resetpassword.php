<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Resetpassword extends Mailable
{
    use Queueable, SerializesModels;
     public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $this->subject('Bridge PNR identifiants')
             ->from('no-reply@consulat-benin-pnr.org','Consulat Honoraire du Bénin à Pointe-Noire')
             ->view('mails.resetpassword');
    }
}

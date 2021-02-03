<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserWelcome extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     */
     protected $password;

     /**
      * Create a new message instance.
      *
      * @return void
      */
     public function __construct($password)
     {
         $this->password = $password;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.user-welcome', ['password' => $this->password])
            ->from("noreply@webdo.cz", "Webdo Agent")
            ->cc("noreply@webdo.cz", "Webdo Agent")
            ->bcc("noreply@webdo.cz", "Webdo Agent")
            ->replyTo("info@webdo.cz", "Webdo Agent")
            ->subject("Posíláme vám údaje k pihlášení");
    }
}

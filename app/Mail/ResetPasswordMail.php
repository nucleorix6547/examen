<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $link;

    public function __construct(Usuario $user, $link)
    {
        $this->user = $user;
        $this->link = $link;
    }

    public function build()
    {
        return $this->subject('Restablecer contraseña - Facultad')
                    ->view('emails.reset_password')
                    ->with([
                        'nombre' => $this->user->nombre,
                        'link' => $this->link,
                    ]);
    }
}
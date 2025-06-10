<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendDataUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $username;
    protected $password;
    protected $nama;

    public function __construct($username, $password, $nama)
    {
        $this->username = $username;
        $this->password = $password;
        $this->nama = $nama;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $subject = 'PEMIRA PNC | Username dan Password Akun Pemilih';

        return (new MailMessage)
                    ->subject($subject)
                    ->markdown('emails.send-data-user', [
                        'username' => $this->username,
                        'password' => $this->password,
                        'nama' => $this->nama,
                        'url' => env('APP_URL')
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

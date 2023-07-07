<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserPasswordChangeNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $user;
    protected $userVia;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [$notifiable->userVia->toString()];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // return (new MailMessage)
        //     ->subject('Password Change Notification')
        //     ->greeting('Password Change')
        //     ->line('Hi ' . $this->user->name . ', this is to notify you that your password has been changed.')
        //     ->line('Thank you for using our application!');

        return (new MailMessage)
            ->subject('Notification - Password Change')
            ->markdown('emails.user_password_change', ['name' => $this->user->name]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'subject' => 'Password Change',
            'message' => 'Your password has been changed.',
        ];
    }
}

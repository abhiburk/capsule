<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNotification extends Notification
{
    use Queueable;


    public function __construct(public Message $message)
    {
        $this->message = $message;
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
        return (new MailMessage)
            ->greeting("Hello {$notifiable->name}👋!")
            ->subject('🎉 Your Time Capsule Has Been Unlocked!')
            ->line('✨ Relive Your Past, Embrace Your Present ✨')
            ->line("The moment you've been waiting for has arrived! Your time capsule, created on {$this->message->created_at->toFormattedDateString()}, is now unlocked and ready for you to explore.")
            ->action('View Your Time Capsule Now', url('/'))
            ->line('Want to create another time capsule? Keep the tradition alive and write a new message to your future self.')
            ->line('Thank you for using our service! 🙏')
            ->salutation('Best regards, The Time Capsule Team');
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

<?php

namespace App\Notifications;

use App\Models\Letter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LetterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Letter $letter;

    public function __construct(string $letterId)
    {
        $this->letter = Letter::find($letterId);
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting("Hello 👋!")
            ->subject('🎉 Your Time Capsule Has Been Unlocked!')
            ->line('✨ Relive Your Past, Embrace Your Present ✨')
            ->line("The moment you've been waiting for has arrived! Your time capsule, created on {$this->letter->created_at->toFormattedDateString()}, is now unlocked and ready for you to explore.")
            ->action('View Your Time Capsule Now', url('/'))
            ->line('Want to create another time capsule? Keep the tradition alive and write a new letter to your future self.')
            ->line('Thank you for using our service! 🙏')
            ->salutation('Best regards, The Time Capsule Team');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Notifications;

use App\Models\TeamInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamInvitationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public TeamInvitation $invitation)
    {
        //
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
            ->subject('Invitation to join team ' . $this->invitation->team->name)
            ->greeting('Hello!')
            ->line('You have been invited by ' . $this->invitation->invitedBy->name . ' to join the team **' . $this->invitation->team->name . '** on ' . config('app.name') . '.')
            ->line('If you do not have an account, you will be asked to create one after clicking the button below.')
            ->action('Accept Invitation', route('invitations.accept', ['token' => $this->invitation->token]))
            ->line('If you did not expect this invitation, you can safely ignore this email.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public
    function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

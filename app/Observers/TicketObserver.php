<?php

namespace App\Observers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        $actor = Auth::user() ?? $ticket->author;

        if ($actor) {
            $ticket->activityLogs()->create([
                'actor_id' => $actor->id,
                'actor_type' => get_class($actor),
                'action' => 'created',
            ]);
        }
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        $actor = Auth::user();

        if (! $actor) {
            return;
        }

        $changes = $ticket->getDirty();

        foreach ($changes as $field => $newValue) {
            if (in_array($field, ['status', 'priority', 'assigned_id'])) {
                $oldValue = $ticket->getOriginal($field);

                if ($oldValue !== $newValue) {
                    $ticket->activityLogs()->create([
                        'actor_id' => $actor->id,
                        'actor_type' => get_class($actor),
                        'action' => 'updated',
                        'field' => $field,
                        'old_value' => $oldValue instanceof \UnitEnum ? $oldValue->value : (string) $oldValue,
                        'new_value' => $newValue instanceof \UnitEnum ? $newValue->value : (string) $newValue,
                    ]);
                }
            }
        }
    }
}

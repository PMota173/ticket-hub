<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'is_private',
        'is_active',
        'user_id',
    ];

    protected static function booted() {
        static::creating(function ($team) {
            $slug = \Str::slug($team->name);

            if(static::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . uniqid();
            }

            $team->slug = $slug;
        });
    }


    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user')->withPivot('is_admin')->withTimestamps();
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function hasAdmin(User $user): bool
    {
        return $this->users()->where('user_id', $user->id)->wherePivot('is_admin', true)->exists();
    }

    public function invites(): HasMany
    {
        return $this->hasMany(TeamInvitation::class);
    }

    public function robots(): HasMany
    {
        return $this->hasMany(TeamRobot::class);
    }
}

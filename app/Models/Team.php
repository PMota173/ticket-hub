<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user')->withPivot('is_admin')->withTimestamps();
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    function hasAdmin(User $user)
    {
        return $this->users()->where('user_id', $user->id)->wherePivot('is_admin', true)->exists();
    }
}

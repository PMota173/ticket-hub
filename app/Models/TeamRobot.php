<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamRobot extends Model implements Authenticatable
{
    use HasApiTokens, AuthenticatableTrait, HasFactory;

    protected $fillable = [
        'team_id',
        'name'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function tickets(): MorphMany
    {
        return $this->morphMany(Ticket::class, 'author');
    }
}

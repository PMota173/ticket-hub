<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_published',
        'view_count',
        'team_id',
        'author_id',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Article $article) {
            if (! $article->slug) {
                $baseSlug = Str::slug($article->title);
                $slug = $baseSlug;
                $count = 1;
                while (static::where('team_id', $article->team_id)->where('slug', $slug)->exists()) {
                    $slug = $baseSlug.'-'.$count++;
                }
                $article->slug = $slug;
            }
        });
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}

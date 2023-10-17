<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Reply extends Model
{
    use HasFactory;
    
    protected $table = 'replies';

    protected $fillable = [
        'user_id',
        'post_id',
        'reply',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reply) {
            if( ! App::runningInConsole() ) {
                $reply->user_id = auth()->id();
            }
        });
    }

    protected $appends = ['forum'];
    
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getForumAttribute(){
        return $this->post->forum;
    }
}

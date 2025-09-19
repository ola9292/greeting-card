<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'message',
        'sender_name',
        'recipient_name',
        'occasion',
        'background_id',
        'song_id',
        'slug',
    ];

    // Relationships
    public function background()
    {
        return $this->belongsTo(Background::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}

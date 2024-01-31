<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Integration extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketplace_id',
        'user_id',
        'username',
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function marketplace(): BelongsTo
    {
        return $this->belongsTo(Marketplace::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

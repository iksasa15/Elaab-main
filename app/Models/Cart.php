<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_id',
        'quantity',
    ];

    /**
     * Get the game associated with the cart item.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Get the user who owns the cart item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
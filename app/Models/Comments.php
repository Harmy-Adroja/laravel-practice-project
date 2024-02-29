<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    Protected $fillable=['user_id', 'comments', 'ticket_id'];

    public function user()
{
    return $this->belongsTo(User::class);
}
}

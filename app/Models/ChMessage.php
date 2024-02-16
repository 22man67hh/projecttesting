<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;

class ChMessage extends Model
{
    use UUID;
    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}

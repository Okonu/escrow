<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'account_no', 'address', 'date_of_birth'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

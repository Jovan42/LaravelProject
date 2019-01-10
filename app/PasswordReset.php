<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $fillable = [
        'user_id', 'link'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

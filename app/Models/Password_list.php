<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Password_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'url',
        'management_account',
        'management_account_password',
        'comment'
     ];

    public function s_user(): BelongsTo
    {
        return $this->belongsTo(S_user::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    public function g_users(): HasMany
    {
        return $this->hasMany(G_user::class);
    }

    public function g_password_lists(): HasMany
    {
        return $this->hasMany(G_password_list::class);
    }

    public function s_user(): BelongsTo
    {
        return $this->belongsTo(S_user::class);
    }
}

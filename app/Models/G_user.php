<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class G_user extends Model
{
    use HasFactory;

    protected $fillable =['group_id','user_id','authorizer_flag','withdrawal_flag'];

    public function s_user(): BelongsTo
    {
        return $this->belongsTo(S_user::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}

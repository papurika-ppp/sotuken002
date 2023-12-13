<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class S_user extends Model
{
    
    protected $firrable =['user_id','user_name'];
    
    
    use HasFactory;

    public function g_users(): HasMany
    {
        return $this->hasMany(G_user::class);
    }

    public function password_lists(): HasMany
    {
        return $this->hasMany(Password_list::class);
    }

    public function g_password_lists(): HasMany
    {
        return $this->hasMany(G_password_list::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Rag\app\Traits\HasEmbeddings;

class Team extends Model
{
    use HasEmbeddings;
    
    protected $fillable = ['name', 'email', 'phone', 'team_role_id', 'bio', 'photo', 'order', 'active'];

    public function role()
    {
        return $this->belongsTo(TeamRole::class, 'team_role_id');
    }

    public function getRoleNameAttribute()
    {
        return $this->role ? $this->role->name : '';
    }
}

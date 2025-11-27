<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Rag\app\Traits\HasEmbeddings;

class Team extends Model
{
    use HasEmbeddings;
    
    protected $fillable = ['name', 'email', 'phone', 'team_role_id', 'bio', 'photo', 'order', 'active'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Rag\app\Traits\HasEmbeddings;

class Service extends Model
{
    use HasEmbeddings;
    
    protected $fillable = ['title', 'description', 'icon', 'order', 'active'];
}

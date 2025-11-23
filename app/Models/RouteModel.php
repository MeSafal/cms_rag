<?php
// app/Models/RouteModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteModel extends Model
{
    use HasFactory;

    protected $table = 'routes';  // The name of the table, if different from the model name
    protected $fillable = ['name', 'uri'];  // The columns you want to fill

    // If you don't need timestamps, you can disable them
    // public $timestamps = false;
}

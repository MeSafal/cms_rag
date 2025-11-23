<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Setting extends Model
{
    use HasFactory;

    // Dynamically set the table name using the prefix from .env
    protected $table;
    protected $primaryKey = 'setting_id';

    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);

    //     $this->table = env('TABLE_PREFIX', '') . 'settings';
    // }

    // Fillable fields
    protected $fillable = [
        'switch_state',
        'profile_image',
        'selected_color',
        'custom_color',
        'display_order',
        'status',
        'createdby',
        'updatedby'
    ];

    // Automatically handle created_at and updated_at
    public $timestamps = true;

    // Mutators for `createdby` and `updatedby` fields
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->createdby = Auth::check() ? Auth::id() : 1;
            $article->updatedby = Auth::check() ? Auth::id() : 1;
            $article->display_order = static::getNextDisplayOrder();
        });

        static::updating(function ($article) {
            $article->updatedby = Auth::check() ? Auth::id() : 1;
        });
    }

    // Method to calculate the next display_order
    public static function getNextDisplayOrder()
    {
        $maxOrder = static::max('display_order');
        return $maxOrder ? $maxOrder + 1 : 1;
    }
}

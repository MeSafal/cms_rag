<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Label extends Model
{
    use HasFactory;

    protected $table;

    protected $primaryKey = 'labels_id';

    public $timestamps = false;
    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);

    //     $this->table = env('TABLE_PREFIX', '') . 'labels';
    // }

    protected $fillable = [
        'en',
        'alias',
        'np',
        'hi',
        'status',
        'display_order',
        'createdby',
        'created_at',
        'updatedby',
        'updated_at',
    ];

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
    public static function getNextDisplayOrder()
    {
        $maxOrder = static::max('display_order');
        return $maxOrder ? $maxOrder + 1 : 1;
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'createdby');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updatedby');
    }
}

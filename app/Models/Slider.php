<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Slider extends Model
{
    use HasFactory;

    // Dynamically set the table name using the prefix from .env
    protected $table = 'sliders';

    protected $primaryKey = 'sliders_id';

    // Fillable fields
    protected $fillable = [
        'sliders_id',
        'title',
        'subtitle',
        'alias',
        'cover',
        'remarks',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'template_id',
        'display_order',
        'status',
        'createdby',
        'updatedby',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    // Mutators for createdby and updatedby fields
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->createdby = Auth::check() ? Auth::id() : 1;
            $model->updatedby = Auth::check() ? Auth::id() : 1;
            $model->display_order = static::getNextDisplayOrder();
        });

        static::updating(function ($model) {
            $model->updatedby = Auth::check() ? Auth::id() : 1;
        });
    }

    // Method to calculate the next display_order
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

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id', 'templates_id');
    }
}

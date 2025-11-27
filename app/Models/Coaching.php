<?php

namespace App\Models;

use App\Traits\ModelScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Rag\app\Traits\HasEmbeddings;  // ← ADD THIS

class Coaching extends Model
{
    use HasFactory, ModelScopes, HasEmbeddings;  // ← ADD HasEmbeddings

    // Dynamically set the table name using the prefix from .env
    protected $table = 'coachings';

    protected $primaryKey = 'coachings_id';

    //optional, if you want more then title field to be searchable
    //the model is still searchable with title without this
    //protected $searchable = ['title', 'slug'];

    // Fillable fields
    protected $fillable = [
        'coachings_id',
        'title',
        'alias',
        'cover',
        'thumb',
        'description',
        'entries',
        'seo_title',
        'seo_keyword',
        'seo_description',
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

    // public function childrenItem()
    // {
    //     return $this->hasMany(Coaching::class, 'parent', 'coachings_id')->where('status', '<>', 0)->orderBy('display_order', 'asc');
    // }

    // public function parentItem()
    // {
    //     return $this->belongsTo(Coaching::class, 'parent')->where('status', '<>', 0);
    // }
}

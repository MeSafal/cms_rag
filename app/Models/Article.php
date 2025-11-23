<?php

namespace App\Models;

use App\Traits\ModelScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory, ModelScopes;

    // Dynamically set the table name using the prefix from .env
    protected $table;

    protected $primaryKey = 'articles_id';

    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);

    //     $this->table = env('TABLE_PREFIX', '') . 'articles';
    // }

    // Fillable fields
    protected $fillable = [
        'title',
        'subtitle',
        'alias',
        'cover',
        'parent',
        'thumb',
        'description',
        'entries',
        'remarks',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'template_id',
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

        static::creating(callback: function ($article) {
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
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'createdby');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updatedby');
    }

    public function parentArticle()
    {
        return $this->belongsTo(Article::class, 'parent');
    }
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id', 'templates_id');
    }
}



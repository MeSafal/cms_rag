<?php

namespace App\Traits;

trait ModelScopes
{
    // Active status scope
    public function scopeActiveStatus($query)
    {
        if (in_array('status', $this->getFillable())) {
            return $query->where('status', '<>', 0);
        }
        return $query;
    }
    public function scopePublished($query)
    {
        if (in_array('status', $this->getFillable())) {
            return $query->where('status', 1);
        }
        return $query;
    }

    // Search scope (column-aware)
    public function scopeSearch($query, $term)
{
    $model = new static;

    $searchColumns = property_exists($model, 'searchable')
        ? $model->searchable
        : ['title'];

    return $query->where(function($q) use ($term, $searchColumns, $model) {
        foreach ($searchColumns as $column) {
            if (in_array($column, $model->getFillable())) {
                $q->orWhere($column, 'LIKE', "%{$term}%");
            }
        }
    });
}


    // Ordering scope
    public function scopeOrdered($query)
    {
        if (in_array('display_order', $this->getFillable())) {
            return $query->orderBy('display_order', 'asc');
        }
        return $query;
    }
}

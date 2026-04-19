<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoCollection extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'status',
    ];

    public function options()
    {
        return $this->hasMany(CollectionOption::class, 'collection_id');
    }
}

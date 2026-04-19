<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionOption extends Model
{
    protected $fillable = [
        'collection_id',
        'option_key',
        'option_value',
    ];

    public function collection()
    {
        return $this->belongsTo(InfoCollection::class, 'collection_id');
    }
}

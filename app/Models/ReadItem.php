<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadItem extends Model
{
    protected $fillable = [
        'user_id', 'item_id'
    ];

    
}

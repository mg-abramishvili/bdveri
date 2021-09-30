<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'base_price',
        'old_price',
        'description',
    ];

    public function colors()
    {
        return $this->belongsToMany('App\Models\Color');
    }
}

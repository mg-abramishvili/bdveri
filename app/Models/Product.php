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

    public function sizes()
    {
        return $this->belongsToMany('App\Models\Size');
    }

    public function constructs()
    {
        return $this->belongsToMany('App\Models\Construct');
    }

    public function manufacturers()
    {
        return $this->belongsToMany('App\Models\Manufacturer');
    }

    public function types()
    {
        return $this->belongsToMany('App\Models\Type');
    }

    public function styles()
    {
        return $this->belongsToMany('App\Models\Style');
    }

    public function productions()
    {
        return $this->belongsToMany('App\Models\Production');
    }

    public function surfaces()
    {
        return $this->belongsToMany('App\Models\Surface');
    }
}

<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\BelongsTenantScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, BelongsTenantScope;

    protected $fillable = ['name', 'description', 'slug'];

    public function setNameAttribute($prop)
    {
        $this->attributes['name'] = $prop;
        $this->attributes['slug'] = Str::slug($prop);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}

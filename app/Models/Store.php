<?php
namespace App\Models;

use App\Models\Category;
use App\Traits\BelongsTenantScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory, BelongsTenantScope;
    protected $fillable = ['name', 'description', 'logo', 'cover', 'subdomain'];

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    

}

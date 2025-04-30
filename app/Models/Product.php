<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'stock',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 0);
    }

    public function getInStockAttribute()
    {
        return $this->stock > 0;
    }

    // public function setStockAttribute($value)
    // {
    //     $this->attributes['stock'] = $value +100;
    // }
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }
}

<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
		'star','customer','review'
	];
    public function product()
    {
    	return $this->belongsTo(Product::class); 
    }
}

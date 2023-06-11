<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shopping_cart_detail extends Model
{
    use HasFactory;
    protected $fillable =['id_productos','shopping_cart_id','quantity'];
}

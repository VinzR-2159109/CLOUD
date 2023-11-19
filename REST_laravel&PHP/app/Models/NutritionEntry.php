<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionEntry extends Model
{
    use HasFactory;

    protected $fillable = ['food_name', 'calories', 'protein', 'carbohydrates', 'fat'];
}

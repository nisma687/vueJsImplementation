<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description', 
        'image', 
        'price',
        'type',
        
    ];
    protected $dates = ['deleted_at'];

    
    
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }


}

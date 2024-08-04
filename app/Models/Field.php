<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'field_category_id',
        'name',
        'description',
        'price',
        'address',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(FieldCategory::class, 'field_category_id');
    }

    public function availabilities()
    {
        return $this->hasMany(FieldAvailability::class);
    }
}

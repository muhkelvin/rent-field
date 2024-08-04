<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldAvailability extends Model
{
    use HasFactory;
    protected $fillable = ['field_id', 'available_from', 'available_until', 'day_of_week'];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}

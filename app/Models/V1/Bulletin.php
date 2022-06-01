<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'price',
        'description',
        'general_photo',
        'current_page'
    ];



    public function photos() {
        return $this->hasMany(Photo::class);
    }
}

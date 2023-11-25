<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function movie(){

        return $this->hasMany(Movie::class)->orderby('id','DESC');// tra nhieu phim
    }
}

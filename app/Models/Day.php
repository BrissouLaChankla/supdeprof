<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'teacher_id',
        'goal',
        'is_today',
        'class_year',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function getIconAttribute() {
        if($this->courses()->exists()){
            return $this->hasMany(Course::class)->first()->chapter->icon;
        } else {
            return "fa-solid fa-book";
        }
    }
}

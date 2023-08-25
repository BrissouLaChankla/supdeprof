<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'title',
        'slug',
        'context',
        'presentation_iframe',
        'chapter_id',
        'teacher_id',
        'day_id',
        'is_visible',   
    ];

    public function chapter() {
        return $this->hasOne(Chapter::class, 'id', 'chapter_id');
    }

    public function sections() {
        return $this->hasMany(Section::class);
    }

    public function teacher() {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }

    public function day() {
        return $this->hasOne(Day::class);
    }


    public function getTeacherFullNameAttribute()
    {
        return $this->teacher->firstname . ' ' . $this->teacher->lastname;
    }

    public function getIconAttribute() {
        return $this->chapter->icon;
    }
    
    }

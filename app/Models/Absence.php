<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

     protected $fillable = [
            'day',
            'student_id',
            'group_id',
     ];

     public function student()
     {
         return $this->hasMany(Student::class);
     }

    public function group()
    {
        return $this->hasMany(Group::class);
    }
}

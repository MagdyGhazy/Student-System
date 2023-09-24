<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

     protected $fillable = [
            'name',
            'email',
            'password',
            'phone',
            'grade_id',
            'group_id',
            'parent_id',
     ];
    protected $guarded = ['is_attend'];

     public function grade()
     {
        return $this->belongsTo(Grade::class);
     }

    public function parent()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}

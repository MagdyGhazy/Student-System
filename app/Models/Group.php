<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

     protected $fillable = [
            'day',
            'start_at',
            'end_at',
            'headquarter_id',
            'grade_id',
     ];

     public function grade()
     {
         return $this->belongsTo(Grade::class);
     }

    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }

}

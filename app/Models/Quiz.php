<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory,SoftDeletes;

     protected $fillable = [
            'name',
            'day',
            'grade_id',
     ];

     public function grade():BelongsTo
     {
         return $this->belongsTo(Grade::class);
     }
     public function question(): HasMany
     {
         return $this->hasMany(Question::class);
     }

}

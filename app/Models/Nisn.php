<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nisn extends Model
{
    protected $table = 'nisns';
    protected $fillable = ['nisn','student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

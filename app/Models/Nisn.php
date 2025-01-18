<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nisn extends Model
{
    protected $fillable = ['person_id', 'nisn'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}

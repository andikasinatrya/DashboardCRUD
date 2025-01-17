<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persones';

    protected $fillable = ['name', 'nisn'];

    public function telephones()
    {
        return $this->hasMany(Telephone::class, 'person_id');
    }
}


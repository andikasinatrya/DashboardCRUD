<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persones';

    protected $fillable = ['name'];

    public function nisn(){
        return $this->hasOne(Nisn::class);
    }

    public function telephones()
    {
        return $this->hasMany(Telephone::class, 'person_id');
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'hobby_person', 'person_id', 'hobby_id');
    }
}


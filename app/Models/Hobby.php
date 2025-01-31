<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    
    protected $table = 'hobbies';

    protected $fillable = [
        'name',
    ];

    public function persones()
    {
        return $this->belongsToMany(Person::class, 'hobby_person', 'hobby_id', 'person_id');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    protected $table = 'telephones';
    protected $fillable = ['telephone_number', 'person_id'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}



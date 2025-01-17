<?php

namespace App\Models;

use App\Models\Nisn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'name',
    ];

    public function nisn(){
        return $this->hasOne(Nisn::class);
    }
}

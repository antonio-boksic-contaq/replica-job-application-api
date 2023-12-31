<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    //RELAZIONI MANY TO MANY

    // job applications
    // ?

    // job positions
    public function jobPositions(){
        return $this->belongsToMany(JobPosition::class);
    }
}
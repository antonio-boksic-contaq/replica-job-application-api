<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosition extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    // RELAZIONI ONE TO MANY
    public function jobApplications(){
        return $this->hasMany(JobApplication::class);
    }

    //RELAZIONI MANY TO MANY

    //questions
}
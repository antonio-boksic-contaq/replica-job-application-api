<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
//devo importare logsactivity e softdeletes


class Candidate extends Model
{
    use HasFactory, SoftDeletes;
    //log activity e softdeletes

    protected $guarded = ['id'];

    // RELAZIONI ONE TO MANY
    public function jobApplications(){
        return $this->hasMany(JobApplication::class);
    }

}
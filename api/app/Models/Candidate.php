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

    // quando mi creerò la tabella job_application gestirò anche la relazione.
    // public function job_application() {
    //     return $this->belongsTo(JobApplication::class);
    // }

}
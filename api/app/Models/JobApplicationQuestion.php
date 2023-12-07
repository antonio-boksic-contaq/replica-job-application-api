<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicationQuestion extends Model
{
    use HasFactory;

    //questo mi serve per poter indicare a che tabella mi sto riferendo 
    //mi serve per la relazione customQuestions() di job application
    protected $table = 'job_application_question';
    protected $guarded = ['id'];

}
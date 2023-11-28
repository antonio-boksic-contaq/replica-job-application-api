<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplicationResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    //aggiungere relazione nel momento in cui si presentano
}
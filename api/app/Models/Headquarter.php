<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Headquarter extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    //aggiungere relazioni nel momento in cui si presetano
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    // RELAZIONI ONE TO MANY

    public function acquisitionChannel() {
        return $this->belongsTo(AcquisitionChannel::class);
    }

    public function candidate() {
        return $this->belongsTo(Candidate::class);
    }

    public function headquarter() {
        return $this->belongsTo(Headquarter::class);
    }

    public function JobApplicationRejectionReason() {
        return $this->belongsTo(JobApplicationRejectionReason::class);
    }

    public function JobApplicationResult() {
        return $this->belongsTo(JobApplicationResult::class);
    }

    public function JobPosition() {
        return $this->belongsTo(JobPosition::class);
    }

    //RELAZIONI MANY TO MANY

    //questions
    public function questions(){
        return $this->belongsToMany(Question::class)
        ->orderBy('description')
        ->withPivot('id','custom_question', 'answer')
        ->withTimestamps();
    }

    // relazione con le domande custom
    public function customQuestions(){
        return $this->hasMany(JobApplicationQuestion::class)->orderBy('custom_question')->whereNull('question_id');
    }
}
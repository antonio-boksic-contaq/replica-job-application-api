<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            "id"=> $this->id,
            "file_path"=> $this->file_path,
            "date" => $this->date,
            "videocall_link" => $this->videocall_link,
            "performed" => $this->performed,
            "rating" => $this->rating,
            "note" => $this->note,
            //qui devo gestire le foreign keys
            "candidate" => new CandidateResource($this->candidate),
            "headquarter"=> new HeadquarterResource($this->headquarter),
            "job_position"=> new JobPositionResource($this->jobPosition),
            "acquisition_channel" => new AcquisitionChannelResource($this->acquisitionChannel),
            "job_application_result" => new JobApplicationResultResource($this->jobApplicationResult),
            'job_application_rejection_reason' => new JobApplicationRejectionReasonResource($this->jobApplicationRejectionReason),
            //mi mancano da gestire tabelle pivot
            'questions' => QuestionResource::collection($this->whenLoaded('questions')),
            'custom_questions' => $this->whenLoaded('customQuestions'),
        ];
    }
}
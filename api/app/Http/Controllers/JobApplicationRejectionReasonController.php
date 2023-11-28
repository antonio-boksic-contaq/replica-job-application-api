<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobApplicationRejectionReasonResource;
use App\Models\JobApplicationRejectionReason;
use Illuminate\Http\Request;
use App\Http\Requests\JobApplicationRejectionReasonRequest;
class JobApplicationRejectionReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobApplicationRejectionReasons = JobApplicationRejectionReason::all();

        return response()->json(JobApplicationRejectionReasonResource::collection($jobApplicationRejectionReasons));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobApplicationRejectionReasonRequest $request)
    {
        $jobApplicationRejectionReason= JobApplicationRejectionReason::create($request->all());

        return response()->json(new JobApplicationRejectionReasonResource($jobApplicationRejectionReason));
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplicationRejectionReason $jobApplicationRejectionReason)
    {
        return response()->json(new JobApplicationRejectionReasonResource($jobApplicationRejectionReason));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplicationRejectionReason $jobApplicationRejectionReason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationRejectionReasonRequest $request, JobApplicationRejectionReason $jobApplicationRejectionReason)
    {
    $jobApplicationRejectionReason->update($request->all());
    return response()->json(new JobApplicationRejectionReasonResource($jobApplicationRejectionReason));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(JobApplicationRejectionReason $jobApplicationRejectionReason)
    {
        return $jobApplicationRejectionReason->delete() ? 
        response()->json(["message"=> "JARR eliminato con successo", "error"=> false]) :
        response()->json(["message"=> "errore con eliminazione JARR", "error"=> true]);


    }

    public function restore ($id) {
        $jobApplicationRejectionReason= JobApplicationRejectionReason::withTrashed()->find($id);

        return $jobApplicationRejectionReason->restore() ?
        response()->json(["message"=> "Jarr ripristinato correttamente" , "error" => false,]):
        response()->json(["message"=> "Jarr ripristinato correttamente" , "error" => false,]);

    }
}
<?php

namespace App\Http\Controllers;

use App\Models\JobApplicationResult;
use Illuminate\Http\Request;
use App\http\Resources\JobApplicationResultResource;
use App\http\Requests\JobApplicationResultRequest;


class JobApplicationResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobApplicationResults = JobApplicationResult::all();

        return response()->json(JobApplicationResultResource::collection($jobApplicationResults));
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
    public function store(JobApplicationResultRequest $request)
    {
        $jobApplicationResult = JobApplicationResult::create($request->all());
        return response()->json(new JobApplicationResultResource($jobApplicationResult));

    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplicationResult $jobApplicationResult)
    {
        return response()->json(new JobApplicationResultResource($jobApplicationResult));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplicationResult $jobApplicationResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationResultRequest $request, JobApplicationResult $jobApplicationResult)
    {
        $jobApplicationResult->update($request->all());

        return response()->json(new JobApplicationResultResource($jobApplicationResult));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(JobApplicationResult $jobApplicationResult)
    {
       return $jobApplicationResult->delete() ?
       response()->json(["error" =>  false, "message" => "cancellazione JAR avvenuta con successo"]) :
       response()->json(["error"=> true,"message"=> "errore con la cancellazione del JAR"]);
    }

    public function restore($id) {
        $jobApplicationResult = JobApplicationResult::withTrashed()->find($id);

        return $jobApplicationResult->restore() ?
        response()->json(["error"=> false,"message"=> "ripristino JAR avvenuto con successo"]) :
        response()->json(["error"=> true,"message"=> "errora con ripristino del JAR"]);
    }
}
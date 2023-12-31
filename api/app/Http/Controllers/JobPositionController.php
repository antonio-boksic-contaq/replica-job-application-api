<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobPositionResource;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use App\Http\Requests\JobPositionRequest;

class JobPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobPosition::orderBy('description');

        //filtro
        if($request->has('questions') && $request->get('questions') == 1) $query->with('questions');

        return response()->json(JobPositionResource::collection($query->get()));

        //prima di vedere il codice di Mattia io l ho gestita semplicemente cosi la index
        // non mi serviva nemmeno la request nel parametro della index.
        //$jobs = JobPosition::all();
        //return response()->json(JobPositionResource::collection($jobs));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPositionRequest $request)
    {
        $jobPosition = JobPosition::create($request->all());
        
        //qui mi devo far ripetere perchè devo gestire la situazione in cui questions non sia nella request
        $questions = $request->has('questions') ? $request->get('questions') : [];
        $jobPosition->questions()->sync($questions);

        return response()->json(new JobPositionResource($jobPosition));     
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPosition $jobPosition)
    {
        return response()->json(new JobPositionResource($jobPosition));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPosition $jobPosition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobPositionRequest $request, JobPosition $jobPosition)
    {
        $jobPosition->update($request->all());

        $questions = $request->has('questions') ? $request->get('questions') : [];
        $jobPosition->questions()->sync($questions);

        return response()->json(new JobPositionResource($jobPosition));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(JobPosition $jobPosition)
    {
        return $jobPosition->delete() ?
        response()->json(["error" => false,"message"=> "job position eliminata con successo"]) :
        response()->json(["error" => true, "message"=> "errore con cancellazione job position"]) ;
    }

    public function restore($id) {
        $jobPosition = JobPosition::withTrashed()->find($id);

        return $jobPosition->restore() ?
        response()->json(["error" => false,"message"=> "job position ripristinata con successo"]) :
        response()->json(["error" => true, "message"=> "errore con ripristino job position"]) ;
    }
}
<?php

namespace App\Http\Controllers;


use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Resources\CandidateResource;
use App\Http\Requests\CandidateRequest;


class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = Candidate::all();
        // return $candidates;

        return CandidateResource::collection($candidates);
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
    public function store(CandidateRequest $request)
    {      

       $candidate = Candidate::create($request->all());

        return new CandidateResource($candidate);
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        return new CandidateResource($candidate);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CandidateRequest $request, Candidate $candidate)
    {
        $candidate->update($request->all());
        return new CandidateResource($candidate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Candidate $candidate)
    {
        return $candidate->delete() ?
        response()->json(["error" => false, "message"=> "candidato cancellato correttamente"]) :
        response()->json(["error" => true, "message"=> "c'è stato un errore nella cancellazione"]);
    }

     public function restore ($id) {
        
        $candidate = Candidate::withTrashed()->find($id);
        return $candidate->restore() ?
        response()->json(["error"=> false, "message"=> "candidato ripristinato correttamente"]) :
        response()->json(["error" => true, "message"=> "c'è stato un errore nel ripristino del candidato"]);
     }
}
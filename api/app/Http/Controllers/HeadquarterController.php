<?php

namespace App\Http\Controllers;

use App\Http\Resources\HeadquarterResource;
use App\Http\Requests\HeadquarterRequest;
use App\Models\Headquarter;
use Illuminate\Http\Request;

class HeadquarterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headquarters = Headquarter::all();
        
        return response()->json(HeadquarterResource::collection($headquarters));
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
    public function store(HeadquarterRequest $request)
    {
        $headquarter = Headquarter::create($request->all());
        return response()->json(new HeadquarterResource($headquarter));
    }

    /**
     * Display the specified resource.
     */
    public function show(Headquarter $headquarter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Headquarter $headquarter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HeadquarterRequest $request, Headquarter $headquarter)
    {
        $headquarter->update($request->all());
        return response()->json(new HeadquarterResource($headquarter));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Headquarter $headquarter)
    {
        return $headquarter->delete() ? 
        response()->json(["message"=> "sede eliminata correttamente", "error" => false]) :
        response()->json(["message"=> "errore durante eliminazione sede", "error"=> true]);
    }

    public function restore ($id) {
        $headquarter = Headquarter::withTrashed()->find($id);

        return $headquarter->restore() ?
        response()->json(["message"=> "sede ripristinata correttamente", "error"=> false]) :
        response()->json(["message"=> "errore durante ripristino sede", "error"=> true]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Resources\AcquisitionChannelResource;
use App\Models\AcquisitionChannel;
use Illuminate\Http\Request;
use App\Http\Requests\AcquisitionChannelRequest;


class AcquisitionChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acquisitionChannels = AcquisitionChannel::all();

        return response()->json(AcquisitionChannelResource::collection($acquisitionChannels));
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
    public function store(AcquisitionChannelRequest $request)
    {
        $channel = AcquisitionChannel::create($request->all());

        return response()->json(new AcquisitionChannelResource($channel));
    }

    /**
     * Display the specified resource.
     */
    public function show(AcquisitionChannel $acquisitionChannel)
    {
        return response()->json(new AcquisitionChannelResource($acquisitionChannel));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcquisitionChannel $acquisitionChannel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcquisitionChannelRequest $request, AcquisitionChannel $acquisitionChannel)
    {
        $acquisitionChannel->update($request->all());

        return response()->json(new AcquisitionChannelResource($acquisitionChannel));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(AcquisitionChannel $acquisitionChannel)
    {
        return $acquisitionChannel->delete() ?
        response()->json(["message"=> "Acquisition channel eliminato con successo", "error" => false]) :
        response()->json(["message"=> "eliminazione Acquisition channel non riuscita", "error" => true]);

    }

    public function restore($id)
    {
        $acquisitionChannel = AcquisitionChannel::withTrashed()->find($id);
        return $acquisitionChannel->restore() ?
        response()->json(["message" => "Acquisition channel ripristinato con successo", "error" => false]) :
        response()->json(["message" => "errore durante ripristino Acquisition channel", "error" => true]);
    }
}
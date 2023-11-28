<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();

        return response()->json(QuestionResource::collection($questions));

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
    public function store(QuestionRequest $request)
    {
        $question = Question::create($request->all());
        return response()->json(new QuestionResource($question));
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return response()->json(new QuestionResource($question));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question->update($request->all());
        return response()->json(new QuestionResource($question));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Question $question)
    {
        return $question->delete() ?
        response()->json(["message"=> "cancellazione domanda avvenuta con successo", "error"=> false]) :
        response()->json(["message"=> "errore con cancellazione domanda", "error"=> true]);
    }

    public function restore($id) {
        $question = Question::withTrashed()->find($id);

        return $question->restore() ?
        response()->json(["message"=> "ripristino domanda avvenuto con successo", "error"=> false]) :
        response()->json(["message"=> "errore con ripristino domanda", "error"=> true]);

    }
}
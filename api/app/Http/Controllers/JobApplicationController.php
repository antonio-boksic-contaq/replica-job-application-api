<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationRequest;
use App\Http\Resources\JobApplicationResource;
use App\Models\Candidate;
use App\Models\JobApplication;
use App\Models\JobPosition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobApplications= JobApplication::all();
        return response()->json(JobApplicationResource::collection($jobApplications));
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
    public function store(JobApplicationRequest $request)
    {
        //prima gestiamo l'upload del file e la creazione del file_path
        $timestamp = Carbon::now()->timestamp;
        $candidate = Candidate::find($request->candidate_id);
        $file_name = $timestamp.'_'.$candidate->name.'_'.$candidate->lastname.'.pdf';
        //per ora ho creato il file_name con il quale cariherò il file nello storage

        //ora posso gestire effettivamente l upload del file nello storage
        Storage::putFileAs('docs/curricula', $request->file('file') , $file_name);

        // creo il file path e lo inserisco nella request
        $file_path = '/curricula/'.$file_name;
        $request->merge(['file_path' => $file_path]);

        $jobApplication = JobApplication::create($request->except('file'));

        if($jobApplication) {
            // $this->storeQuestion($jobApplication);
            // questo non l'ho incluso negli appunti per ora
            return response()->json(new JobApplicationResource($jobApplication));
        } else {
            $jobApplication->delete();
            Storage::delete($file_path);
            return response()->json(["error" => true]);
        } 

    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        return response()->json(new JobApplicationResource($jobApplication));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationRequest $request, JobApplication $jobApplication)
    {
        // se c'è un nuovo file nella request, devo gestire l'upload e l'eliminazione del file precedente
        if($request->has("file")) {
            //salvo nome del vecchio file per poterlo eliminare a fine aggiornamento
            $oldFileName = explode("/", $jobApplication->file_path);

            //creo nome per il nuovo file
            $timestamp = Carbon::now()->timestamp;
            // questo candidate in realtà non ho bisogno di trovarlo, già so qual è
            //$candidate = Candidate::find($request->candidate_id);
            //quindi posso scriverlo cosi
            $candidate = $jobApplication->candidate;
            $file_name = $timestamp.'_'.$candidate->name.'_'.$candidate->lastname.'.pdf';

            //ora posso gestire effettivamente l upload del file nello storage
            Storage::putFileAs('docs/curricula', $request->file('file') , $file_name);

            // creo il file path e lo inserisco nella request
            $file_path = '/curricula/'.$file_name;
            $request->merge(['file_path' => $file_path]);
        }

         // se aggiornamento è andato a buon fine...
         if($jobApplication->update($request->except('file'))) {
        // questa credo che non mi serve per il momento
            //if(array_key_exists('job_position_id', $jobApplication->getChanges())) $this->storeQuestion($jobApplication);
            
            //se ho creato un oldfileName, lo cancello
            if(isset($oldFileName)) Storage::disk('curricula')->delete($oldFileName[2]);
            // mi mando JA aggiornata come risposta
            return response()->json(new JobApplicationResource($jobApplication));
          //se non è andato a buon fine, cancello il file che ho appena ricevuto dal disco
        } else {
            if ($request->hasFile('file')) Storage::disk('curricula')->delete($file_name);
            return response()->json(["error" => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(JobApplication $jobApplication)
    {
       return $jobApplication->delete() ?
       response()->json(["error" => false, "message" => "job application eliminata con successo"]) :
       response()->json(["error"=> true, "message"=> "errore con eliminazione della job application"]);

    }

    public function restore($id)
    {
        $jobApplication = JobApplication::withTrashed()->find($id);
        
        return $jobApplication->restore() ? 
        response()->json(["error" => false, "message" => "job application ripristinata con successo"]) :
        response()->json(["error"=> true, "message"=> "errore con ripristino della job application"]);

    }

    //da qui gestiamo le many to many

    public function storeCustomQuestion(Request $request, JobApplication $jobApplication)
    {
        $jobApplication->customQuestions()->create([
            'custom_question' => $request->get('custom_question'),
            'answer' => $request->get('answer')
        ]);
        
        return response()->json(["error" => false, "message"=> "inserimento domanda custom andato a buon fine"]);
    }

    public function storeQuestion(JobApplication $jobApplication)
    {
        dd(JobPosition::find($jobApplication->job_position_id)->questions()->pluck("questions.id")->toArray());

        $questions = JobPosition::find($jobApplication->job_position_id)->questions()->pluck('questions.id')->toArray();
        $jobApplication->questions()->sync($questions);        
        return response()->json(["error" => false]);
    }

    

}
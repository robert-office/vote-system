<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Http\Resources\OptionsResource;
use App\Models\Option;
use App\Models\Survey;
use Illuminate\Support\Facades\Redirect;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::paginate(10)->through(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'end_date' => $item->end_date,
                'start_date' => $item->start_date
            ];
        });
        return inertia('Surveys/Index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Surveys/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSurveyRequest $request)
    {
        $survey = Survey::create($request->validated());

        if (!$survey) {
            return Redirect::route('enquetes.create', array());
        }

        return Redirect::route('options.create', array('survey' => $survey));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey = Survey::find($id);
        if(!$survey){
            return Redirect::route('enquetes.index');
        }

        $options = $survey->options;

        $votes = Option::where('survey_id', $survey->id)->withCount('votes')->get();
        $votes = collect($votes)->map(function($vote){
            return [
                'id' => $vote->id,
                'count' => $vote->votes_count
            ];
        });

        $votes = array('data' => $votes);
        return inertia('Surveys/Show', compact('survey', 'options', 'votes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $survey = Survey::find($id);
        if(!$survey){
            return Redirect::route('enquetes.index');
        }

        return inertia('Surveys/Edit', compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSurveyRequest $request, $id)
    {
        $survey = Survey::find($id);
        if(!$survey){
            return Redirect::route('enquetes.index');
        }

        $survey->update($request->validated());
        return redirect("enquetes/" . $survey->id . "/edit")->with('success', 'Enquete Atualizada Com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $survey = Survey::find($id);
        if(!$survey){
            return Redirect::route('enquetes.index');
        }

        $survey->delete();
        return Redirect::route('enquetes.index');
    }
}

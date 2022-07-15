<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Http\Resources\VotesResource;
use App\Models\Option;
use App\Models\Survey;
use Carbon\Carbon;
use DateTime;
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
        if (!$survey) {
            return redirect('enquetes')->with('failed', 'Houve um erro ao tentar acessar a enquete...');
        }

        $options = $survey->options;
        $votes = VotesResource::collection(Option::where('survey_id', $survey->id)->withCount('votes')->get());

        $now = Carbon::now();
        $startDate = (new Carbon)->parse($survey->start_date);
        $endDate = (new Carbon)->parse($survey->end_date);
        $infos = array(
            'survey_is_open' => $startDate->lessThan($now) && $endDate->greaterThan($now)
        );

        return inertia('Surveys/Show', compact('survey', 'options', 'votes', 'infos'));
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
        if (!$survey) {
            return redirect('enquetes')->with('failed', 'Houve um erro ao tentar acessar a enquete...');
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
        if (!$survey) {
            return redirect('enquetes')->with('failed', 'Houve um erro ao tentar editar aquela enquete...');
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
        if (!$survey) {
            return redirect('enquetes')->with('failed', 'Houve um erro ao tentar deletar aquela enquete...');
        }

        $survey->delete();
        return Redirect::route('enquetes.index');
    }
}

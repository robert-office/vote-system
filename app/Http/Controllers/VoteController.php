<?php

namespace App\Http\Controllers;

use App\Events\VoteAdded;
use App\Http\Requests\StoreVoteRequest;
use App\Models\Survey;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class VoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoteRequest $request)
    {
        $requestValidated = $request->validated();

        $survey = Survey::find($request->survey_id);
        if (!$survey) {
            return redirect('enquetes')->with('failed', 'Impossivel editar as opções dessa enquete');
        }

        $now = Carbon::now();
        $startDate = (new Carbon)->parse($survey->start_date);
        $endDate = (new Carbon)->parse($survey->end_date);
        if (!$startDate->lessThan($now) || !$endDate->greaterThan($now)) {
            return redirect('enquetes')->with('failed', 'Tentou votar em uma enquete encerrada...');
        }


        if ($vote = Vote::create($requestValidated)) {
            event(new VoteAdded($vote->survey_id));
            return Redirect::route('enquetes.show', ['enquete' => $request->survey_id])->with('success', 'Voto computado com sucesso');
        }
    }
}

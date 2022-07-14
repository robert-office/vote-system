<?php

namespace App\Http\Controllers;

use App\Events\VoteAdded;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestValidated = $request->validate([
            'survey_id' => 'required',
            'option_id' => 'required'
        ]);

        if ($vote = Vote::create($requestValidated)) {
            event(new VoteAdded($vote->survey_id));
            return Redirect::route('enquetes.show', ['enquete' => $request->survey_id])->with('success', 'Voto computado com sucesso');
        }
    }
}

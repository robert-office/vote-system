<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOptionRequest;
use App\Models\Option;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OptionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Options/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOptionRequest $request)
    {
        $validatedData = $request->validated();
        $options = $validatedData['options'];

        $survey = Survey::find($request->survey_id);
        if(!$survey){
            return redirect('enquetes')->with('failed', 'Impossivel adicionar opções a essa enquete');
        }

        $survey->options()->createMany($options);

        return Redirect::route('enquetes.index');
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
            return redirect('enquetes')->with('failed', 'Impossivel editar as opções dessa enquete');
        }

        $options = $survey->options->toArray();

        return inertia('Options/Edit', compact('options', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $options = $request->options;
        $survey = Survey::find($id);
        $survey->options()->delete();
        $survey->options()->createMany($options);

        return redirect("options/$id/edit")->with('success', 'Opções Editadas com sucesso!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Technology;
use App\Models\Type;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = Work::all();
        return view('admin.works.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.works.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkRequest $request)
    {
        // dd($request);
        // die();
        $form_data = $request->validated();
        $form_data['slug'] = Work::generateSlug($request->title);
        $checkPost = Work::where('slug', $form_data['slug'])->first();

        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo progetto, cambia il titolo']);
        }

        $newWork = Work::create($form_data);

        //in questo modo andiamo a chiamare il metodo creato all'interno di work
        //e attacchiamo al suo id l'id di technology
        //aggiungiamo un controllo per evitari schermate di errori nel caso in cui alla creazione 
        //non venga selezionato alcun campo in technologies
        if($request->has('technologies')){
            $newWork->technologies()->attach($request->technologies);
        }

        return to_route('admin.works.show', ['work'=> $newWork->id])->with('status', 'Progetto aggiornato!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $technologies = Technology::all();
        $work = Work::findOrFail($id);
        return view('admin.works.show', compact('work', 'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $technologies = Technology::all();
        $types = Type::all();
        $work = Work::findOrFail($id);
        return view('admin.works.edit', compact('work','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Work::generateSlug($request->title);
        $checkPost = Work::where('slug', $form_data['slug'])->where('id', '<>', $work->id)->first();

        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug']);
        }

        $work->technologies()->sync($request->technologies);
        $work->update($form_data);

        return to_route('admin.works.show',['work' => $work->id])->with('status', 'Progetto aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return redirect()->route('admin.works.index');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Http\Requests\StoreEstudioRequest;
use App\Http\Requests\UpdateEstudioRequest;
use Illuminate\Http\Request;

class EstudioController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');
        $estudios = Estudio::where('nombre', 'like', '%' . $search . '%')->get();
        return response()->json($estudios);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$estudios = Estudio::all();
        return view('estudios.index');
        // tambien debe enviar las areas    
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
    public function store(StoreEstudioRequest $request)
    {
        Estudio::create($request->all());
        return redirect()->route('estudios.index')->with('success', 'Estudio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudio $estudio)
    {
        return view('estudios.show', compact('estudio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudio $estudio)
    {
        return view('estudios.edit', compact('estudio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstudioRequest $request, Estudio $estudio)
    {
        $estudio->update($request->all());
        return redirect()->route('estudios.index')->with('success', 'Estudio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudio $estudio)
    {
        //
    }
}

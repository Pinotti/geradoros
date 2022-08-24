<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->term != '') {
            $fabricantes = Fabricante::where('nome', 'like', '%' . $request->term . '%')
                ->orderBy('nome')
                ->paginate(10);
        } else {
            $fabricantes = Fabricante::query()->orderBy('nome')->paginate(10);
        }
        
        return view('app.fabricante.index', ['fabricantes' => $fabricantes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Fabricante::create($request->all());
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
        $novoNome = $request->nome;
        $fabricante = Fabricante::find($id);
        $fabricante->nome = $novoNome;
        $fabricante->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fabricante = Fabricante::find($id);
        $fabricante->delete();

        return redirect()->route('fabricante.index');
    }
}

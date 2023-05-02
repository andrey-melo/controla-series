<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy(column: 'nome')->get();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');

        return view('series.index')->with('series', $series)->with('mensagem.sucesso', $mensagemSucesso);
    }
    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        Serie::create($request->all());

        return to_route('series.index');
    }
    public function destroy(Request $request){

        Serie::destroy($request->series);
        $request->session()->put('mensagem.sucesso', 'Série removida com sucesso');

        return to_route('series.index');
    }
    public function edit(Serie $series)
    {
        return view('series.edit')->with('serie', $series);
    }
}

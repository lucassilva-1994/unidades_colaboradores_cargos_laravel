<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesempenhoRequest;
use App\Models\CargoColaborador;
use App\Models\Colaborador;
use App\Models\HelperModel;

class DesempenhoController extends Controller
{
    public function show(){
        $desempenhos = CargoColaborador::with('colaborador.cargo','colaborador.unidade')->orderByDesc('nota_desempenho')->paginate(50);
        return view('colaboradores.desempenho.show',compact('desempenhos'));
    }

    private function desempenhos(int $colaborador_id, int $id = null){
        $desempenhos =  CargoColaborador::get();
        $desempenho =  CargoColaborador::whereId($id)->first();
        $colaborador = Colaborador::whereId($colaborador_id)->first();
        return view('colaboradores.desempenho.form', compact('desempenhos','desempenho','colaborador'));
    }

    public function new(int $colaborador_id){
        return $this->desempenhos($colaborador_id);
    }

    public function edit(int $id, int $desempenho_id){
        return $this->desempenhos($id,$desempenho_id);
    }

    public function create(DesempenhoRequest $request){
        if(HelperModel::setData($request->except('_token'), CargoColaborador::class))
            return redirect()->route('colaborador.desempenho.show')->with('success','Sucesso.');
        return redirect()->route('colaborador.desempenho.show')->with('error','Falha.');
    }

    public function update(DesempenhoRequest $request){
        if(HelperModel::updatedata($request->only('id','nota_desempenho'),CargoColaborador::class,['id' => $request->id]))
            return redirect()->route('colaborador.desempenho.show')->with('success','Sucesso.');
        return redirect()->route('colaborador.desempenho.show')->with('error','Falha.');
    }
}

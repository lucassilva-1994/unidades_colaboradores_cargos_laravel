<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesempenhoRequest;
use App\Models\CargoColaborador;
use App\Models\Colaborador;
use Illuminate\Http\Request;

class DesempenhoController extends Controller
{
    public function show(Request $request){
        if(!empty($request->search)){
            $desempenhos = CargoColaborador::search($request->search);
            return view('colaboradores.desempenho.show',compact('desempenhos'));
        }
        $desempenhos = CargoColaborador::with('colaborador.cargo','colaborador.unidade')->orderByDesc('nota_desempenho')->paginate(50);
        return view('colaboradores.desempenho.show',compact('desempenhos'));
    }

    private function desempenhos(string $colaborador_id, int $id = null){
        $desempenhos =  CargoColaborador::get();
        $desempenho =  CargoColaborador::find($id);
        $colaborador = Colaborador::find($colaborador_id);
        return view('colaboradores.desempenho.form', compact('desempenhos','desempenho','colaborador'));
    }

    public function new(string $colaborador_id){
        return $this->desempenhos($colaborador_id);
    }

    public function edit(string $id, int $desempenho_id){
        return $this->desempenhos($id,$desempenho_id);
    }

    public function create(DesempenhoRequest $request){
        if(CargoColaborador::updateOrCreate($request->only('colaborador_id','cargo_id','nota_desempenho')))
            return redirect()->route('colaborador.desempenho.show')->with('success','Sucesso.');
        return redirect()->route('colaborador.desempenho.show')->with('error','Falha.');
    }

    public function update(DesempenhoRequest $request){
        if(CargoColaborador::updateOrCreate(['id' => $request->id],$request->only('colaborador_id','cargo_id','nota_desempenho')))
            return redirect()->route('colaborador.desempenho.show')->with('success','Sucesso.');
        return redirect()->route('colaborador.desempenho.show')->with('error','Falha.');
    }
}

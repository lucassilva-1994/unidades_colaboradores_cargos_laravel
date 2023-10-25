<?php

namespace App\Http\Controllers;

use App\Models\CargoColaborador;
use App\Models\Colaborador;
use App\Models\HelperModel;
use Illuminate\Http\Request;

class DesempenhoController extends Controller
{
    public function show(){
        $desempenhos = CargoColaborador::orderByDesc('nota_desempenho')->get();
        return view('colaboradores.desempenho.show',compact('desempenhos'));
    }

    private function desempenhos(int $colaborador_id, int $id = null){
        $desempenhos =  CargoColaborador::get();
        $desempenho =  CargoColaborador::whereId($id)->first();
        $colaborador = Colaborador::whereId($colaborador_id)->first();
        return view('colaboradores.desempenho.form', compact('desempenhos','desempenho','colaborador'));
    }

    private function redirect($class, $message){
        return redirect()->back()->with($class, $message);
    }

    public function new(int $colaborador_id){
        return $this->desempenhos($colaborador_id);
    }

    public function edit(int $id, int $desempenho_id){
        return $this->desempenhos($id,$desempenho_id);
    }

    public function create(Request $request){
        $request->validate(
            ['nota_desempenho' => 'required'],
            ['nota_desempenho.required' => 'Nota é obrigatório']
        );
        if(HelperModel::setData($request->except('_token'), CargoColaborador::class))
            return $this->redirect('success','Avaliação enviada.');
        return $this->redirect('error','Falha ao enviar avaliação.');
    }

    public function update(Request $request){
        $request->validate(
            ['nota_desempenho' => 'required'],
            ['nota_desempenho.required' => 'Nota é obrigatório']
        );
        if(HelperModel::updatedata($request->only('id','nota_desempenho'),CargoColaborador::class,['id' => $request->id]))
            return $this->redirect('success','Avaliação atualizada.');
        return $this->redirect('error','Falha ao atualizar avaliação.');
    }
}

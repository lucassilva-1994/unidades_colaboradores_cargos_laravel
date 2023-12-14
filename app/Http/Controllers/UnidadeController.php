<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadeRequest;
use App\Models\HelperModel;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    public function show(){
        $unidades = Unidade::with('colaboradores')->withCount('colaboradores')->orderByDesc('colaboradores_count','DESC')->paginate(20);
        return view('unidades.show', compact('unidades'));
    }

    private function unidades(string $id = null){
        $unidades = Unidade::orderByDesc('order')->limit(10)->get();
        $unidade = Unidade::find($id);
        return view('unidades.form', compact('unidade','unidades'));
    }

    private function redirect($class, $message){
        return redirect()->back()->with($class, $message);
    }

    public function new(){
        return $this->unidades();
    }

    public function edit(string $id){
        return $this->unidades($id);
    }

    public function create(UnidadeRequest $request){
        $request->validate(
            [ 'nome_fantasia' => 'unique:unidades,nome_fantasia', 'razao_social' => 'unique:unidades,razao_social', 'cnpj' => 'unique:unidades,cnpj']
        );
        if(HelperModel::setData($request->except('_token'),Unidade::class))
            return $this->redirect('success','Salvo com sucesso.');
        return $this->redirect('error','Falha ao salvar.');
    }

    public function update(UnidadeRequest $request){
        if(HelperModel::updateData($request->except('id','_method','_token'),Unidade::class,['id' => $request->id]))
            return $this->redirect('success','Salvo com sucesso.');
        return $this->redirect('error','Falha ao salvar.');
    }

    public function delete(string $id){
        if(Unidade::find($id)->delete())
            return $this->redirect('success','Removido com sucesso.');
        return $this->redirect('error','Falha ao remover.');
    }
}

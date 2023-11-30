<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadeRequest;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    public function show(){
        $unidades = Unidade::with('colaboradores')->withCount('colaboradores')->orderByDesc('colaboradores_count','DESC')->paginate(20);
        return view('unidades.show', compact('unidades'));
    }

    private function unidades(int $id = null){
        $unidades = Unidade::orderByDesc('id')->limit(10)->get();
        $unidade = Unidade::whereId($id)->first();
        return view('unidades.form', compact('unidade','unidades'));
    }

    private function redirect($class, $message){
        return redirect()->back()->with($class, $message);
    }

    public function new(){
        return $this->unidades();
    }

    public function edit(int $id){
        return $this->unidades($id);
    }

    public function create(UnidadeRequest $request){
        $request->validate(
            [ 'nome_fantasia' => 'unique:unidades,nome_fantasia', 'razao_social' => 'unique:unidades,razao_social', 'cnpj' => 'unique:unidades,cnpj'],
            [ 'nome_fantasia.unique' => 'Nome fantasia já cadastrado.', 'razao_social.unique' => 'Razão social já cadastrado.', 'cnpj.unique' => 'CNPJ já cadastrado.']
        );
        if(Unidade::createOrUpdate($request->except(['_token'])))
            return $this->redirect('success','Salvo com sucesso.');
        dd('parou aqui.');
        return $this->redirect('error','Falha ao salvar.');
    }

    public function update(UnidadeRequest $request){
        if(Unidade::createOrUpdate($request->only('id','nome_fantasia','razao_social','cnpj')))
            return $this->redirect('success','Salvo com sucesso.');
        return $this->redirect('error','Falha ao salvar.');
    }

    public function delete(int $id){
        if(Unidade::whereId($id)->delete())
            return $this->redirect('success','Removido com sucesso.');
        return $this->redirect('error','Falha ao remover.');
    }
}

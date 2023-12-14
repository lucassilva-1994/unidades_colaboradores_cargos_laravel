<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColaboradorRequest;
use App\Models\Cargo;
use App\Models\Colaborador;
use App\Models\HelperModel;
use App\Models\Unidade;

class ColaboradorController extends Controller
{
    public function show(){
        $colaboradores = Colaborador::with('desempenho','cargo','unidade')->orderByDesc('order')->paginate(50);
        return view('colaboradores.show',compact('colaboradores'));
    }

    private function colaboradores(string $id = null){
        $colaboradores = Colaborador::with('unidade','cargo')->orderByDesc('order')->limit(10)->get();
        $colaborador = Colaborador::whereId($id)->first();
        $unidades = $this->getUnidades();
        $cargos = $this->getcargos();
        return view('colaboradores.form', compact('colaboradores', 'colaborador', 'unidades', 'cargos'));
    }

    private function redirect($class, $message){
        return redirect()->back()->with($class, $message);
    }

    public function new(){
        return $this->colaboradores();
    }

    public function edit($id){
        return $this->colaboradores($id);
    }

    public function create(ColaboradorRequest $request){
        $request->validate(
            ['cpf' => 'unique:colaboradores,cpf','email' => 'unique:colaboradores,email'],
            ['cpf.unique' => 'CPF já cadastrado','email.unique' => 'Email já cadastrado.']
        );
        if (HelperModel::setData($request->except('_method'),Colaborador::class));
            return $this->redirect('success', 'Salvo com sucesso.');
        return $this->redirect('error', 'Erro ao salvar.');
    }

    public function update(ColaboradorRequest $request){
        if (HelperModel::updateData($request->except(['_token','_method','id']),Colaborador::class,['id' => $request->id]))
            return $this->redirect('success', 'Atualizado com sucesso.');
        return $this->redirect('error', 'Falha ao atualizar.');
    }

    public function delete(string $id)
    {
        if (Colaborador::find($id)->delete())
            return $this->redirect('success', 'Removido com sucesso.');
        return $this->redirect('error', 'Falha ao remover.');
    }

    private function getUnidades(){
        return Unidade::orderByDesc('id')->get();
    }

    private function getcargos(){
        return Cargo::orderByDesc('cargo')->get();
    }
}

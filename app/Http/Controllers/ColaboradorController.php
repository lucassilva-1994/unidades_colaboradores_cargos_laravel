<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColaboradorRequest;
use App\Models\Cargo;
use App\Models\Colaborador;
use App\Models\Unidade;

class ColaboradorController extends Controller
{
    public function show(){
        $colaboradores = Colaborador::orderByDesc('id')->paginate(15);
        return view('colaboradores.show',compact('colaboradores'));
    }

    private function colaboradores(int $id = null){
        $colaboradores = Colaborador::orderByDesc('id')->limit(10)->get();
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
        if (Colaborador::createOrUpdate($request->except('_method')))
            return $this->redirect('success', 'Salco com sucesso.');
        return $this->redirect('error', 'Erro ao salvar.');
    }

    public function update(ColaboradorRequest $request){
        if (Colaborador::createOrUpdate($request->only(['id','nome','email','cpf','unidade_id','cargo_id'])))
            return $this->redirect('success', 'Atualizado com sucesso.');
        return $this->redirect('error', 'Falha ao atualizar.');
    }

    public function delete(int $id)
    {
        if (Colaborador::whereId($id)->delete())
            return $this->redirect('success', 'Removido com sucesso.');
        return $this->redirect('error', 'Falha ao remover.');
    }

    private function getUnidades(){
        return Unidade::orderByDesc('nome_fantasia')->get();
    }

    private function getcargos(){
        return Cargo::orderByDesc('cargo')->get();
    }
}

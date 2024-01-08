<?php

namespace App\Http\Controllers;

use App\Helpers\Redirect;
use App\Helpers\Model;
use App\Http\Requests\ColaboradorRequest;
use App\Models\Cargo;
use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    use Redirect, Model;
    public function show(Request $request){
        if(!empty($request->search)){
            $colaboradores = Colaborador::search($request->search,10);
            return view('colaboradores.show',compact('colaboradores'));
        }
        $colaboradores = Colaborador::with('desempenho','cargo','unidade')->orderByDesc('order')->paginate(50);
        return view('colaboradores.show',compact('colaboradores'));
    }

    private function colaboradores(string $id = null){
        $colaboradores = Colaborador::with('unidade','cargo')->orderByDesc('order')->limit(10)->get();
        $colaborador = Colaborador::find($id);
        $unidades = $this->getUnidades();
        $cargos = $this->getcargos();
        return view('colaboradores.form', compact('colaboradores', 'colaborador', 'unidades', 'cargos'));
    }

    public function new(){
        return $this->colaboradores();
    }

    public function edit($id){
        return $this->colaboradores($id);
    }

    public function create(ColaboradorRequest $request){
        if (self::setData($request->except('_method'),Colaborador::class));
            return self::redirect('success','criado');
        return self::redirect('error', 'criar');
    }

    public function update(ColaboradorRequest $request){
        if (self::updateData($request->except(['_token','_method','id']),Colaborador::class,['id' => $request->id]))
            return self::redirect('success','atualizado');
        return self::redirect('error','atualizar');
    }

    public function delete(string $id)
    {
        if (Colaborador::find($id)->delete())
            return self::redirect('success','excluido');
        return self::redirect('error','excluir');
    }

    private function getUnidades(){
        return Unidade::orderByDesc('id')->get();
    }

    private function getcargos(){
        return Cargo::orderByDesc('cargo')->get();
    }
}

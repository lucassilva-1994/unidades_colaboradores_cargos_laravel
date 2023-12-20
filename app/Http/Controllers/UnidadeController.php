<?php

namespace App\Http\Controllers;

use App\Helpers\Redirect;
use App\Helpers\Model;
use App\Http\Requests\UnidadeRequest;
use App\Models\Unidade;


class UnidadeController extends Controller
{
    use Redirect;
    use Model;
    public function show(){
        $unidades = Unidade::with('colaboradores')->withCount('colaboradores')->orderByDesc('colaboradores_count','DESC')->paginate(20);
        return view('unidades.show', compact('unidades'));
    }

    private function unidades(string $id = null){
        $unidades = Unidade::orderByDesc('order')->limit(10)->get();
        $unidade = Unidade::find($id);
        return view('unidades.form', compact('unidade','unidades'));
    }

    public function new(){
        return $this->unidades();
    }

    public function edit(string $id){
        return $this->unidades($id);
    }

    public function create(UnidadeRequest $request){
        if(self::setData($request->except('_token'),Unidade::class))
            return self::redirect('success','criado');
        return self::redirect('error','criar');
    }

    public function update(UnidadeRequest $request){
        if(self::updateData($request->except('id','_method','_token'),Unidade::class,['id' => $request->id]))
            return self::redirect('success','atualizado');
        return self::redirect('error','atualizar');
    }

    public function delete(string $id){
        if(Unidade::find($id)->delete())
            return self::redirect('success','excluido');
        return self::redirect('error','excluir');
    }
}

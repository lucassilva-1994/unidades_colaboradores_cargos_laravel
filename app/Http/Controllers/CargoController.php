<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    private function cargos(int $id = null)
    {
        $cargos = Cargo::with('colaboradores')->withCount('colaboradores')->orderByDesc('colaboradores_count','DESC')->paginate(10);
        $cargo = Cargo::whereId($id)->first();
        return view('cargos.cargos', compact('cargos', 'cargo'));
    }

    private function redirect($class, $message)
    {
        return redirect()->back()->with($class, $message);
    }

    public function show()
    {
        return $this->cargos();
    }

    public function new()
    {
        return $this->cargos();
    }

    public function edit(int $id)
    {
        return $this->cargos($id);
    }

    public function create(Request $request)
    {
        $request->validate(
            ['cargo' => 'required'],
            ['cargo.required' => 'O cargo é obrigatório.']
        );
        if (Cargo::createOrUpdate($request->except(['_token'])))
            return $this->redirect('success', 'Salvo com sucesso.');
        return $this->redirect('error', 'Falha ao salvar.');
    }

    public function update(Request $request)
    {
        $request->validate(
            ['cargo' => 'required'],
            ['cargo.required' => 'O cargo é obrigatório.']
        );
        if (Cargo::createOrUpdate($request->except(['_token','_method'])))
            return $this->redirect('success', 'Salvo com sucesso.');
        return $this->redirect('error', 'Falha ao salvar.');
    }

    public function delete(int $id)
    {
        if (Cargo::whereId($id)->delete())
            return $this->redirect('success', 'Removido com sucesso.');
        return $this->redirect('error', 'Falha ao remover.');
    }
}

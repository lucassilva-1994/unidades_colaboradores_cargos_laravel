<?php

namespace App\Http\Controllers;

use App\Http\Requests\CargoRequest;
use App\Models\Cargo;
use App\Models\HelperModel;

class CargoController extends Controller
{
    private function cargos(string $id = null)
    {
        $cargos = Cargo::with('colaboradores')->withCount('colaboradores')->orderByDesc('colaboradores_count','DESC')->paginate(10);
        $cargo = Cargo::find($id);
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

    public function edit(string $id)
    {
        return $this->cargos($id);
    }

    public function create(CargoRequest $request)
    {
        if (HelperModel::setData($request->only('cargo'),Cargo::class))
            return $this->redirect('success', 'Salvo com sucesso.');
        return $this->redirect('error', 'Falha ao salvar.');
    }

    public function update(CargoRequest $request)
    {
        if (HelperModel::updateData($request->except('id','_method','_token'),Cargo::class,['id' => $request->id]))
            return $this->redirect('success', 'Salvo com sucesso.');
        return $this->redirect('error', 'Falha ao salvar.');
    }

    public function delete(string $id)
    {
        if (Cargo::find($id)->delete())
            return $this->redirect('success', 'Removido com sucesso.');
        return $this->redirect('error', 'Falha ao remover.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Model;
use App\Http\Requests\CargoRequest;
use App\Models\Cargo;
use App\Helpers\Redirect;

class CargoController extends Controller
{
    use Redirect, Model;

    public function getCargos(){
        $cargos = Cargo::with('colaboradores')->get();
        return response()->json($cargos);
    }
    private function cargos(string $id = null)
    {
        $cargos = Cargo::with('colaboradores')->withCount('colaboradores')->orderByDesc('colaboradores_count','DESC')->paginate(10);
        $cargo = Cargo::find($id);
        return view('cargos.cargos', compact('cargos', 'cargo'));
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
            try {
                self::setData($request->only('cargo'),Cargo::class);
                return response()->json(['message' => 'Registro criado com sucesso.']);
            } catch (\Throwable $th) {
                return response()->json(['message' => "Falha: $th->getMessage()"]);
            }
    }

    public function update(CargoRequest $request)
    {
        try {
            self::updateData($request->except('id','_method','_token'),Cargo::class,['id' => $request->id]);
            return response()->json(['message' => 'Registro atualizado com sucesso.']);
        } catch (\Throwable $th) {
            return response()->json(['message' => "Falha: $th->getMessage()"]);
        }
    }

    public function delete(string $id)
    {
        if (Cargo::find($id)->delete())
            return response()->json('Registro excluido com sucesso.');
        return self::redirect('error','deletar');
    }
}

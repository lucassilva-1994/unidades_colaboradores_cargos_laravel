<?php

namespace App\Http\Controllers;

use App\Helpers\Model;
use App\Http\Requests\CargoRequest;
use App\Models\Cargo;
use App\Helpers\Redirect;

class CargoController extends Controller
{
    use Redirect;
    use Model;
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
        if (self::setData($request->only('cargo'),Cargo::class))
            return self::redirect('success','criado');
        return self::redirect('error','criar');
    }

    public function update(CargoRequest $request)
    {
        if (self::updateData($request->except('id','_method','_token'),Cargo::class,['id' => $request->id]))
            return self::redirect('success','atualizado');
        return self::redirect('error','atualizar');
    }

    public function delete(string $id)
    {
        if (Cargo::find($id)->delete())
            return self::redirect('success','excluido');
        return self::redirect('error','deletar');
    }
}

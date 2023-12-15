<?php
namespace App\Helpers;
Trait Redirect
{
    public static function redirect($class = 'success',$event=null)
    {
        if($class == 'success')
            return redirect()->back()->with('success',"Registro {$event} com sucesso.");
        return redirect()->back()->with('error',"Falha ao {$event} registro.");
    }
}

<?php
namespace App\Traits;

use App\Elemento;
use DB;
trait Elementos
{
    public function debolverElementos($solicitud_id)
    {
        $elementosSolicitados = DB::table('elemento_solicitud')->where('solicitud_id', $solicitud_id)->get();
        foreach ($elementosSolicitados as $el) {
            $elemento              = Elemento::find($el->elemento_id);
            $solicitados           = DB::table('elemento_solicitud')->where('elemento_id', $el->elemento_id)->first();
            $elemento->existencias = $elemento->existencias + $solicitados->cantidad;
            $elemento->save();
        }
    }
}

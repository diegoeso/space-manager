<?php

namespace App;

use App\User;
use App\Usuario;
use Illuminate\Database\Eloquent\Model;

class Evaluaciones extends Model
{
    protected $table    = 'evaluaciones';
    protected $fillable = [
        'cal1',
        'cal2',
        'cal3',
        'cal4',
        'cal5',
        'solicitud_id',
        'evaluador',
        'tipoCuentaEvaluador',
        'evaluado',
        'tipoCuentaEvaluado',
        'estado',
    ];

    public function calificacion($id)
    {

        $evaluaciones = $this->where('evaluado', $id)->where('estado', 1)->get();
        $cal1         = $evaluaciones->sum('cal1');
        $cal2         = $evaluaciones->sum('cal2');
        $cal3         = $evaluaciones->sum('cal3');
        $cal4         = $evaluaciones->sum('cal4');
        $cal5         = $evaluaciones->sum('cal5');
        $cont         = count($evaluaciones);
        if ($cont == 0) {
            $total = ($cal1 + $cal2 + $cal3 + $cal4 + $cal5) / 5;
        } else {
            $total = ($cal1 / $cont + $cal2 / $cont + $cal3 / $cont + $cal4 / $cont + $cal5 / $cont) / 5;
        }
        return $total;
    }
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id', 'id');
    }

    public function evaluadorU()
    {
        return $this->belongsTo(Usuario::class, 'evaluador', 'id');
    }

    public function evaluadoU()
    {
        return $this->belongsTo(Usuario::class, 'evaluado', 'id');
    }

    public function evaluadorR()
    {
        return $this->belongsTo(User::class, ' evaluador', 'id');
    }

    public function evaluadoR()
    {
        return $this->belongsTo(User::class, ' evaluado', 'id');
    }

    public function tipoCuentaEvaluado($evaluacion)
    {
        if ($evaluacion->tipoCuentaEvaluado == 0 || $evaluacion->tipoCuentaEvaluado == 1) {
            return $usuario = User::find($evaluacion->evaluado);
        } else {
            return $usuario = Usuario::find($evaluacion->evaluado);
        }
    }
}

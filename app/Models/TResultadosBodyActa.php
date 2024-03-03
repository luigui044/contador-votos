<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TResultadosBodyActa
 * 
 * @property int $id
 * @property int $id_resultado_head
 * @property int $id_candidato
 * @property int $v_rostro
 * @property int $v_bandera
 * @property int $v_ambos
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property TResultadosHeadActa $t_resultados_head_acta
 *
 * @package App\Models
 */
class TResultadosBodyActa extends Model
{
	protected $table = 't_resultados_body_actas';

	protected $casts = [
		'id_resultado_head' => 'int',
		'id_candidato' => 'int',
		'v_rostro' => 'int',
		'v_bandera' => 'int',
		'v_ambos' => 'int'
	];

	protected $fillable = [
		'id_resultado_head',
		'id_candidato',
		'v_rostro',
		'v_bandera',
		'v_ambos'
	];

	public function t_resultados_head_acta()
	{
		return $this->belongsTo(TResultadosHeadActa::class, 'id_resultado_head');
	}
}

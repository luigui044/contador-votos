<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TResultadosHeadActa
 * 
 * @property int $id
 * @property int $id_jrv
 * @property int $papeletas_entregadas
 * @property int $papeletas_utilizadas
 * @property int $papeletas_sobrantes
 * @property int $papeletas_inutilizadas
 * @property int $papeletas_entregadas_votantes
 * @property int $votos_validos
 * @property int $votos_nulos
 * @property int $votos_impugnados
 * @property int $abstenciones
 * @property int $id_user
 * 
 * @property Collection|TResultadosBodyActa[] $t_resultados_body_actas
 *
 * @package App\Models
 */
class TResultadosHeadActa extends Model
{
	protected $table = 't_resultados_head_actas';
	public $timestamps = false;

	protected $casts = [
		'id_jrv' => 'int',
		'papeletas_entregadas' => 'int',
		'papeletas_utilizadas' => 'int',
		'papeletas_sobrantes' => 'int',
		'papeletas_inutilizadas' => 'int',
		'papeletas_entregadas_votantes' => 'int',
		'votos_validos' => 'int',
		'votos_nulos' => 'int',
		'votos_impugnados' => 'int',
		'abstenciones' => 'int',
		'id_user' => 'int'
	];

	protected $fillable = [
		'id_jrv',
		'papeletas_entregadas',
		'papeletas_utilizadas',
		'papeletas_sobrantes',
		'papeletas_inutilizadas',
		'papeletas_entregadas_votantes',
		'votos_validos',
		'votos_nulos',
		'votos_impugnados',
		'abstenciones',
		'id_user',
		'archivo'
	];

	public function t_resultados_body_actas()
	{
		return $this->hasMany(TResultadosBodyActa::class, 'id_resultado_head');
	}
}

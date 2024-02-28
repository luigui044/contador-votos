<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TResultadosHead
 * 
 * @property int $id
 * @property int $id_jrv
 * @property int $papeletas_entregadas
 * @property int $papeletas_utilizadas
 * @property int $papeletas_sobrantes
 * @property int $papeletas_entregadas_votantes
 * @property int $votos_validos
 * @property int $votos_nulos
 * @property int $votos_impugnados
 * @property int $abstenciones
 * @property int $id_user
 * 
 * @property Jrv $jrv
 * @property User $user
 * @property Collection|TResultadosBody[] $t_resultados_bodies
 *
 * @package App\Models
 */
class TResultadosHead extends Model
{
	protected $table = 't_resultados_head';
	public $timestamps = false;

	protected $casts = [
		'id_jrv' => 'int',
		'papeletas_entregadas' => 'int',
		'papeletas_utilizadas' => 'int',
		'papeletas_sobrantes' => 'int',
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
		'papeletas_entregadas_votantes',
		'votos_validos',
		'votos_nulos',
		'votos_impugnados',
		'abstenciones',
		'id_user'
	];

	public function jrv()
	{
		return $this->belongsTo(Jrv::class, 'id_jrv');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function t_resultados_bodies()
	{
		return $this->hasMany(TResultadosBody::class, 'id_resultado_head');
	}
}

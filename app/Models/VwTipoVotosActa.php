<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwTipoVotosActa
 * 
 * @property float|null $v_validos
 * @property float|null $v_nulos
 * @property float|null $v_impugnados
 * @property float|null $abstenciones
 *
 * @package App\Models
 */
class VwTipoVotosActa extends Model
{
	protected $table = 'vw_tipo_votos_actas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'v_validos' => 'float',
		'v_nulos' => 'float',
		'v_impugnados' => 'float',
		'abstenciones' => 'float'
	];

	protected $fillable = [
		'v_validos',
		'v_nulos',
		'v_impugnados',
		'abstenciones'
	];
}

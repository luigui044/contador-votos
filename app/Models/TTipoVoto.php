<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TTipoVoto
 * 
 * @property float|null $validos
 * @property float|null $nulos
 * @property float|null $impugnados
 * @property float|null $abstenciones
 *
 * @package App\Models
 */
class TTipoVoto extends Model
{
	protected $table = 't_tipo_voto';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'validos' => 'float',
		'nulos' => 'float',
		'impugnados' => 'float',
		'abstenciones' => 'float'
	];

	protected $fillable = [
		'validos',
		'nulos',
		'impugnados',
		'abstenciones'
	];
}

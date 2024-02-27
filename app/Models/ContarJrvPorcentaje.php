<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContarJrvPorcentaje
 * 
 * @property float|null $total_jrv
 *
 * @package App\Models
 */
class ContarJrvPorcentaje extends Model
{
	protected $table = 'contar_jrv_porcentaje';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'total_jrv' => 'float'
	];

	protected $fillable = [
		'total_jrv'
	];
}

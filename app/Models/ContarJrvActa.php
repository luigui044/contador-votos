<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContarJrvActa
 * 
 * @property int $total_jrv
 *
 * @package App\Models
 */
class ContarJrvActa extends Model
{
	protected $table = 'contar_jrv_actas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'total_jrv' => 'int'
	];

	protected $fillable = [
		'total_jrv'
	];
}

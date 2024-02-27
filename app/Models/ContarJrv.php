<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContarJrv
 * 
 * @property float|null $total_jrv
 *
 * @package App\Models
 */
class ContarJrv extends Model
{
	protected $table = 'contar_jrv';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'total_jrv' => 'float'
	];

	protected $fillable = [
		'total_jrv'
	];
}

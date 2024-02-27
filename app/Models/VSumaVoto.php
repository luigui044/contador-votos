<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VSumaVoto
 * 
 * @property float $mp
 * @property float $ws
 * @property float $lc
 * @property float $mj
 * @property float $mm
 * @property float $gf
 * @property float $mv
 *
 * @package App\Models
 */
class VSumaVoto extends Model
{
	protected $table = 'v_suma_votos';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'mp' => 'float',
		'ws' => 'float',
		'lc' => 'float',
		'mj' => 'float',
		'mm' => 'float',
		'gf' => 'float',
		'mv' => 'float'
	];

	protected $fillable = [
		'mp',
		'ws',
		'lc',
		'mj',
		'mm',
		'gf',
		'mv'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwSumaVoto
 * 
 * @property string|null $name
 * @property string|null $partido
 * @property float $votos
 * @property string|null $img
 * @property string|null $color
 *
 * @package App\Models
 */
class VwSumaVoto extends Model
{
	protected $table = 'vw_suma_votos';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'votos' => 'float'
	];

	protected $fillable = [
		'name',
		'partido',
		'votos',
		'img',
		'color'
	];
}

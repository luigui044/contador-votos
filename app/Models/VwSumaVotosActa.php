<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwSumaVotosActa
 * 
 * @property string|null $name
 * @property string|null $partido
 * @property float $votos
 * @property string|null $img
 * @property string|null $color
 *
 * @package App\Models
 */
class VwSumaVotosActa extends Model
{
	protected $table = 'vw_suma_votos_actas';
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

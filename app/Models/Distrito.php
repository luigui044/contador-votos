<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Distrito
 * 
 * @property int $id
 * @property string $distrito
 * @property int|null $id_municipio
 *
 * @package App\Models
 */
class Distrito extends Model
{
	protected $table = 'distritos';
	public $timestamps = false;

	protected $casts = [
		'id_municipio' => 'int'
	];

	protected $fillable = [
		'distrito',
		'id_municipio'
	];
}

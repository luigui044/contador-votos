<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Jrv
 * 
 * @property int $id_jrv
 * @property string|null $centro_vot
 * @property int|null $junta
 * @property int|null $id_centro_vot
 *
 * @package App\Models
 */
class Jrv extends Model
{
	protected $table = 'jrvs';
	protected $primaryKey = 'id_jrv';
	public $timestamps = false;

	protected $casts = [
		'junta' => 'int',
		'id_centro_vot' => 'int'
	];

	protected $fillable = [
		'centro_vot',
		'junta',
		'id_centro_vot'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CentrosVotacion
 * 
 * @property int $id_centro
 * @property string|null $nombre
 *
 * @package App\Models
 */
class CentrosVotacion extends Model
{
	protected $table = 'centros_votacion';
	protected $primaryKey = 'id_centro';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];
}

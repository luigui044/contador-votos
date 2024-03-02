<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TCandidato
 * 
 * @property int $id_candidato
 * @property string|null $candidato
 * @property string|null $img
 * @property string|null $color
 * @property int|null $id_partido
 * 
 * @property Collection|TResultadosBody[] $t_resultados_bodies
 *
 * @package App\Models
 */
class TCandidato extends Model
{
	protected $table = 't_candidatos';
	protected $primaryKey = 'id_candidato';
	public $timestamps = false;

	protected $casts = [
		'id_partido' => 'int'
	];

	protected $fillable = [
		'candidato',
		'img',
		'color',
		'id_partido'
	];

	public function t_resultados_bodies()
	{
		return $this->hasMany(TResultadosBody::class, 'id_candidato');
	}
}

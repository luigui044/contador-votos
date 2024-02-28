<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TResultadosBody
 * 
 * @property int $id
 * @property int $id_resultado_head
 * @property int $id_candidato
 * @property int $v_rostro
 * @property int $v_bandera
 * @property int $v_ambos
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property TResultadosHead $t_resultados_head
 * @property TCandidato $t_candidato
 *
 * @package App\Models
 */
class TResultadosBody extends Model
{
	protected $table = 't_resultados_body';

	protected $casts = [
		'id_resultado_head' => 'int',
		'id_candidato' => 'int',
		'v_rostro' => 'int',
		'v_bandera' => 'int',
		'v_ambos' => 'int'
	];

	protected $fillable = [
		'id_resultado_head',
		'id_candidato',
		'v_rostro',
		'v_bandera',
		'v_ambos'
	];

	public function t_resultados_head()
	{
		return $this->belongsTo(TResultadosHead::class, 'id_resultado_head');
	}

	public function t_candidato()
	{
		return $this->belongsTo(TCandidato::class, 'id_candidato');
	}
}

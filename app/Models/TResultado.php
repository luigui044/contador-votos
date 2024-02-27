<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TResultado
 * 
 * @property int|null $id_result
 * @property int|null $id_centro
 * @property int|null $id_jrv
 * @property int|null $papeletas_entregadas
 * @property int|null $papeletas_utilizadas
 * @property int|null $papeletas_sobrantes
 * @property int|null $votos_validos
 * @property int|null $votos_nulos
 * @property int|null $votos_impugnados
 * @property int|null $abstenciones
 * @property int|null $v_miguel_pereira
 * @property int|null $v_fmln
 * @property int|null $v_ambos_fmln
 * @property int|null $v_total_fmln
 * @property int|null $v_will_salgado
 * @property int|null $v_ni_gana
 * @property int|null $v_ambos_ni_gana
 * @property int|null $v_total_ni_gana
 * @property int|null $v_luwing
 * @property int|null $v_nt
 * @property int|null $v_ambos_nt
 * @property int|null $v_total_nt
 * @property int|null $v_moises
 * @property int|null $v_pdc
 * @property int|null $v_ambos_pdc
 * @property int|null $v_total_pdc
 * @property int|null $v_margarita
 * @property int|null $v_pcn
 * @property int|null $v_ambos_pcn
 * @property int|null $v_total_pcn
 * @property int|null $v_geovanni
 * @property int|null $v_cd
 * @property int|null $v_ambos_cd
 * @property int|null $v_total_cd
 * @property int|null $v_maria
 * @property int|null $v_arena
 * @property int|null $v_ambos_arena
 * @property int|null $v_total_arena
 *
 * @package App\Models
 */
class TResultado extends Model
{
	protected $table = 't_resultados';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_result' => 'int',
		'id_centro' => 'int',
		'id_jrv' => 'int',
		'papeletas_entregadas' => 'int',
		'papeletas_utilizadas' => 'int',
		'papeletas_sobrantes' => 'int',
		'votos_validos' => 'int',
		'votos_nulos' => 'int',
		'votos_impugnados' => 'int',
		'abstenciones' => 'int',
		'v_miguel_pereira' => 'int',
		'v_fmln' => 'int',
		'v_ambos_fmln' => 'int',
		'v_total_fmln' => 'int',
		'v_will_salgado' => 'int',
		'v_ni_gana' => 'int',
		'v_ambos_ni_gana' => 'int',
		'v_total_ni_gana' => 'int',
		'v_luwing' => 'int',
		'v_nt' => 'int',
		'v_ambos_nt' => 'int',
		'v_total_nt' => 'int',
		'v_moises' => 'int',
		'v_pdc' => 'int',
		'v_ambos_pdc' => 'int',
		'v_total_pdc' => 'int',
		'v_margarita' => 'int',
		'v_pcn' => 'int',
		'v_ambos_pcn' => 'int',
		'v_total_pcn' => 'int',
		'v_geovanni' => 'int',
		'v_cd' => 'int',
		'v_ambos_cd' => 'int',
		'v_total_cd' => 'int',
		'v_maria' => 'int',
		'v_arena' => 'int',
		'v_ambos_arena' => 'int',
		'v_total_arena' => 'int'
	];

	protected $fillable = [
		'id_result',
		'id_centro',
		'id_jrv',
		'papeletas_entregadas',
		'papeletas_utilizadas',
		'papeletas_sobrantes',
		'votos_validos',
		'votos_nulos',
		'votos_impugnados',
		'abstenciones',
		'v_miguel_pereira',
		'v_fmln',
		'v_ambos_fmln',
		'v_total_fmln',
		'v_will_salgado',
		'v_ni_gana',
		'v_ambos_ni_gana',
		'v_total_ni_gana',
		'v_luwing',
		'v_nt',
		'v_ambos_nt',
		'v_total_nt',
		'v_moises',
		'v_pdc',
		'v_ambos_pdc',
		'v_total_pdc',
		'v_margarita',
		'v_pcn',
		'v_ambos_pcn',
		'v_total_pcn',
		'v_geovanni',
		'v_cd',
		'v_ambos_cd',
		'v_total_cd',
		'v_maria',
		'v_arena',
		'v_ambos_arena',
		'v_total_arena'
	];
}

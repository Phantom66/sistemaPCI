<?php namespace PCI\Models;

use Illuminate\Database\Query\Builder;
use PCI\Models\Traits\HasCommentsAttribute;
use PCI\Models\Traits\HasTernaryStatusAttribute;

/** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */

/**
 * PCI\Models\Petition
 *
 * @package PCI\Models
 * @author Alejandro Granadillo <slayerfat@gmail.com>
 * @link https://github.com/slayerfat/sistemaPCI Repositorio en linea.
 * @property integer $id
 * @property integer $user_id
 * @property integer $petition_type_id
 * @property \Carbon\Carbon $request_date
 * @property string $comments
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property-read PetitionType $type
 * @property-read User $user
 * @property-read string $formatted_status
 * @property-read \Illuminate\Database\Eloquent\Collection|Item[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|Note[] $notes
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Petition whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Petition whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Petition wherePetitionTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Petition whereRequestDate($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Petition whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Petition whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Petition whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Petition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Petition whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Petition whereUpdatedBy($value)
 */
class Petition extends AbstractBaseModel
{

    use HasTernaryStatusAttribute, HasCommentsAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_date',
        'comments',
        'status',
    ];

    /**
     * Atributos que deben ser mutados a dates, dates
     * se refiere a Carbon\Carbon dates.
     * En otras palabras, genera una instancia
     * de Carbon\Carbon para cada campo.
     *
     * @var array
     */
    protected $dates = ['request_date'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['status' => 'boolean'];

    /**
     * Regresa la cantidad en numeros de items asociados.
     *
     * @return int
     */
    public function getItemCountAttribute()
    {
        return $this->items->count();
    }

    /**
     * @param Builder $query
     * @return Petition[]
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('updated_at', 'desc')->take(4)->get();
    }

    /**
     * Regresa el tipo de pedido asociado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function type()
    {
        return $this->belongsTo(PetitionType::class, 'petition_type_id');
    }

    /**
     * Regresa el usuario asociado al pedido.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Regresa una coleccion de items asociados.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity', 'stock_type_id');
    }

    /**
     * Regresa una coleccion de notas asociadas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * El mensaje a mostrar ['null|true|false'] string
     *
     * @return array
     */
    public function getStatusMessage()
    {
        return [
            'null'  => 'Por aprobar',
            'true'  => 'Aprobado',
            'false' => 'No aprobado',
        ];
    }
}

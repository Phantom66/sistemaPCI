<?php namespace PCI\Models;

/** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */

/**
 * PCI\Models\Note
 * @package PCI\Models
 * @author Alejandro Granadillo <slayerfat@gmail.com>
 * @link https://github.com/slayerfat/sistemaPCI Repositorio en linea.
 * @property integer $id
 * @property integer $user_id
 * @property integer $to_user_id
 * @property integer $attendant_id
 * @property integer $note_type_id
 * @property integer $petition_id
 * @property \Carbon\Carbon $creation
 * @property string $comments
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property-read Petition $petition
 * @property-read User $requestedBy
 * @property-read User $toUser
 * @property-read Attendant $attendant
 * @property-read NoteType $type
 * @property-read \Illuminate\Database\Eloquent\Collection|Item[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|Movement[] $movements
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereToUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereAttendantId($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereNoteTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note wherePetitionId($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereCreation($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\PCI\Models\Note whereUpdatedBy($value)
 */
class Note extends AbstractBaseModel
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'creation',
        'comments',
        'status'
    ];

    /**
     * Atributos que deben ser mutados a dates.
     * dates se refiere a Carbon\Carbon dates.
     * En otras palabras, genera una instancia
     * de Carbon\Carbon para cada campo.
     * @var array
     */
    protected $dates = ['creation'];

    /**
     * Regresa la peticion relacionada a esta nota.
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function petition()
    {
        return $this->belongsTo(Petition::class);
    }

    /**
     * Regresa al usuario relacionado a esta nota.
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function requestedBy()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Regresa el usuario destinatario de la nota.
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function toUser()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Regresa el encargado de almacen.
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function attendant()
    {
        return $this->belongsTo(Attendant::class);
    }

    /**
     * Regresa una el tipo de nota relacionado.
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function type()
    {
        return $this->belongsTo(NoteType::class);
    }

    /**
     * Regresa una coleccion de items asociados.
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }

    /**
     * Regresa una coleccion de movimientos asociados.
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}

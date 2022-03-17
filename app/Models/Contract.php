<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $beekeeper_id
 * @property integer $postcode_id
 * @property integer $created_by
 * @property float $lon
 * @property float $lat
 * @property string $contact_firstname
 * @property string $contact_lastname
 * @property string $contact_phone
 * @property string $info
 * @property string $created_at
 * @property string $updated_at
 * @property Beekeeper $beekeeper
 * @property Postcode $postcode
 * @property User $created_by_user
 * @property Beekeeper[] $beekeepers
 */
class Contract extends Model
{
    use HasFactory;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['beekeeper_id', 'postcode_id', 'created_by', 'lon', 'lat', 'contact_firstname', 'contact_lastname', 'contact_phone', 'info', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function beekeepers()
    {
        return $this->belongsToMany(Beekeeper::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beekeeper()
    {
        return $this->belongsTo(Beekeeper::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function postcode()
    {
        return $this->belongsTo(Postcode::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_by_user() :\App\Models\User
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}

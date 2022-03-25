<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $postcode
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property string $codeName
 * @property Beekeeper[] $beekeepers
 * @property Contract[] $contracts
 */
class Postcode extends Model
{
    use HasFactory;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Model attributes in Database.
     *
     * @var array
     */
    protected $fillable = ['postcode', 'name', 'created_at', 'updated_at'];

    /**
     * Concat postcode and name.
     *
     * @return string
     */
    public function getCodeNameAttribute() :string
    {
        return $this->postcode .' '. $this->name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function beekeepers()
    {
        return $this->belongsToMany(Beekeeper::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}

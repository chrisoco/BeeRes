<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $fullName
 * @property string $phone
 * @property string $phone_verified_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Contract[] $contracts_applicable
 * @property Postcode[] $postcodes
 * @property Contract[] $contracts
 */
class Beekeeper extends Model
{
    use HasFactory, Notifiable;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'firstname', 'lastname', 'phone', 'phone_verified_at', 'created_at', 'updated_at'];


    public function getFullNameAttribute()
    {
        return $this->firstname .' '. $this->lastname;
    }

    public function getFormattedPhoneAttribute()
    {
        return reverseFormatPhoneNum($this->phone);
    }

    public function getJurisdictionsToStringAttribute()
    {
        $res = '';

        foreach ($this->postcodes()->pluck('name', 'postcode') as $postcode => $name) {
            $res .= $postcode.' '.$name.', ';
        }

        return substr($res, 0, strlen($res) - 2);

    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {
        return $this->phone;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contracts_applicable()
    {
        return $this->belongsToMany(Contract::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function postcodes()
    {
        return $this->belongsToMany(Postcode::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}

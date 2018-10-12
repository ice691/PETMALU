<?php

namespace App;

use App\AdoptionRequest;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile_number', 'birthdate', 'address', 'gender', 'civil_status', 'password', 'role', 'disabled_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at',
    ];

    /**
     * The attributes that will be appended for arrays.
     *
     * @var array
     */
    protected $appends = [
        'login_status',
    ];

    public function adoptionRequest(Pet $pet)
    {
        return $pet->adoptionRequests()->whereUserId($this->id)->first();
    }

    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    /**
     * Determine if user is of current role
     *
     * @param  string $role
     * @return boolean
     */
    public function is($role)
    {
        return strtolower($role) === strtolower($this->role);
    }

    /**
     * The master list format
     *
     * @param  QueryBuilder $query
     * @return QueryBuilder $query
     */
    public function scopeFieldsForMasterList($query)
    {
        return $query;
    }

    /**
     * Constraint to access only standard users
     *
     * @param  QueryBuilder $query
     * @return QueryBuilder $query
     */
    public function scopeStandardUsers($query)
    {
        return $query->where('role', 'standard');
    }

    /**
     * Hash the raw password value to bcrypt
     *
     * @param string $val The password value
     */
    public function setPasswordAttribute($val)
    {
        $this->attributes['password'] = bcrypt($val);
    }

    /**
     * Get the login status
     *
     * @return boolean
     */
    public function getLoginStatusAttribute()
    {
        return !$this->disabled_at;
    }

    /**
     * Toggle a users "disabled" status
     *
     * @param boolean $flag
     */
    public function setDisabled($flag = true)
    {
        $disabledAt = $flag ? now()->format('Y-m-d H:i:s') : null;

        return $this->update([
            'disabled_at' => $disabledAt,
        ]);
    }
}

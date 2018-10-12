<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnimalAdoption extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'animal_type',
        'name',
        'description',
        'sex',
        'area',
        'area_longitude',
        'area_latitude',
        'vaccination_status',
        'date_seized',
        'photo',
        'submitted_by',
        'approved_at',
        'rejected_at',
    ];

    protected $casts = [
        'vaccination_status' => 'boolean',
    ];

    protected $appends = [
        'photo_filepath',
        'adoption_status',
        'adoption_status_text',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Returns the fields shown for the master list
     * @param  Builder $query
     * @return Builder
     */
    public function scopeFieldsForMasterList($query)
    {
        return $query;
    }

    public function getPhotoFilePathAttribute()
    {
        return asset("storage/{$this->photo}");
    }

    public function getAdoptionStatusAttribute()
    {
        if (!$this->submitted_by || $this->approved_at) {
            return true;
        }

        if ($this->rejected_at) {
            return false;
        }

        return null;
    }

    public function getAdoptionStatusTextAttribute()
    {
        if ($this->adoption_status) {
            return 'Approved';
        }

        return $this->adoption_status === false ? 'Rejected' : 'Pending';
    }

    public function scopeEligible($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('approved_at')->orWhereNull('submitted_by');
        });
    }
}

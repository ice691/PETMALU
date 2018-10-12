<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
    ];

    protected $appends = [
        'photo_filepath',
        'notes',
    ];

    protected $hidden = [
        'updated_at',
    ];

    protected $fillable = [
        'reason',
        'origin',
        'origin_latitude',
        'origin_longitude',
        'date_seized',
        'cage_number',
        'ownership',
        'habitat',
        'species',
        'pet_name',
        'breed',
        'birthdate',
        'color',
        'sex',
        'female_sex_extra',
        'num_puppies',
        'tag',
        'other_tag_extra',
        'other_animal_contact',
        'date_vaccinated',
        'vaccinated_by',
        'vaccination_source',
        'vaccination_type',
        'vaccine_stock_number',
        'routine_service_activity',
        'other_routine_service_activity_extra',
        'routine_service_remarks',
        'registration_status',
        'created_by',
        'photo',
        'service_type',
    ];

    public function scopeFieldsForMasterList($query)
    {
        return $query->latest();
    }

    public function getPhotoFilepathAttribute()
    {
        return asset("storage/{$this->photo}");
    }

    public function scopeForAdoption($query)
    {
        return $query->whereRegistrationStatus('approved')
            ->whereDoesntHave('approvedAdoptionRequest');
    }

    public function scopeAdopted($query, $startDate = false, $endDate = false)
    {
        return $query->whereHas('approvedAdoptionRequest', function ($q) use ($startDate, $endDate) {
            $q->when($startDate, function ($then) use ($startDate) {
                $then->where('adopted_at', '>=', $startDate);
            })->when($endDate, function ($then) use ($endDate) {
                $then->where('adopted_at', '<=', $endDate);
            });
        })->with([
            'owner:id,name,email,mobile_number,gender,address',
            'approvedAdoptionRequest:id,pet_id,user_id,adoption_purpose,adopted_at,proof_of_adoption',
            'approvedAdoptionRequest.requestor:id,name,email,mobile_number,gender,address',
        ]);
    }

    public function scopeImpounded($query, $startDate = false, $endDate = false)
    {
        return $query->where('registration_status', 'approved')
            ->when($startDate, function ($then) use ($startDate) {
                $then->where('created_at', '>=', $startDate);
            })->when($endDate, function ($then) use ($endDate) {
            $then->where('created_at', '<=', $endDate);
        })->with([
            'owner:id,name,email,mobile_number,gender,address',
        ]);
    }

    public function scopePendingImpound($query)
    {
        return $query->where('registration_status', '!=', 'approved');
    }

    public function loadAdoptionDetails()
    {
        return $this->load([
            'owner',
            'approvedAdoptionRequest',
            'approvedAdoptionRequest.requestor',
        ]);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class)->orderBy('created_at');
    }

    public function approvedAdoptionRequest()
    {
        return $this->hasOne(AdoptionRequest::class)->whereRequestStatus('approved');
    }

    public function scopeWithAdoptionRequests($query)
    {
        return $query->whereHas('adoptionRequests')->with('adoptionRequests');
    }

    public function scopeProfile($query)
    {
        $query->select('id', 'pet_name', 'breed', 'species', 'origin', 'origin_latitude', 'origin_longitude', 'ownership', 'habitat', 'color', 'photo', 'created_by', 'created_at');
    }

    public function isAdopted()
    {
        if ($this->relationLoaded('approvedAdoptionRequest')) {
            return (bool) $this->approvedAdoptionRequest;
        }

        return $this->approvedAdoptionRequest()->exists();
    }

    public function is($status)
    {
        return $this->registration_status === strtolower($status);
    }

    public function getNotesAttribute()
    {
        switch ($this->service_type) {
            case 'stray':
                return 'Stray';
            case 'pickup':
                return 'Pickup at location';
            default:
                return 'To be surrendered';
        }
    }

}

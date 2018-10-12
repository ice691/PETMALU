<?php

namespace App;

use App\Facades\SMS;
use App\Pet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdoptionRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pet_id',
        'user_id',
        'request_status',
        'adoption_purpose',
        'proof_of_adoption',
    ];

    protected $appends = [
        'proof_of_adoption_filepath',
    ];

    protected $dates = [
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    public function scopeFieldsForMasterList($query)
    {
        return $query->whereHas('pet', function ($q) {
            $q->whereRegistrationStatus('approved');
        });
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function requestor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notifyRequestorViaSMS()
    {
        $message = new SMS($this->requestor->mobile_number, 'Hello, please go to the pound');
        return $message->send();
    }

    public function getProofOfAdoptionFilepathAttribute()
    {
        return asset("storage/{$this->proof_of_adoption}");
    }
}

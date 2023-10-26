<?php

namespace App;

use ESolution\DBEncryption\Traits\EncryptedAttribute;
use Illuminate\Support\Facades\DB;

class Referral extends Model
{
    use EncryptedAttribute;




    public static function getCountries()
    {
        return Referral::all()->pluck('country')->unique();
    }

    public static function getCities($country)
    {
        return Referral::whereEncrypted("country", $country)->pluck('city')->unique();
    }

    protected $encryptable = [
        'country',
        'reference_no',
        'organisation',
        'province',
        'district',
        'city',
        'street_address',
        'gps_location',
        'facility_name',
        'facility_type',
        'provider_name',
        'position',
        'phone',
        'email',
        'website',
        'pills_available',
        'code_to_use',
        'type_of_service',
        'note',
        'womens_evaluation'
    ];
}

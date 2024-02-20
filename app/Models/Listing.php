<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'property_id',
        'listing_id',
        'status',
        'branding_name',
        'address_line',
        'address_city',
        'address_state',
        'address_postal_code',
        'address_state_code',
        'description_type',
        'description_beds',
        'description_baths',
        'description_lot_sqft',
        'description_sqft',
        'advertisers_name',
        'advertisers_email',
        'flags_is_price_reduced',
        'flags_is_new_construction',
        'flags_is_foreclosure',
        'flags_is_plan',
        'flags_is_new_listing',
        'flags_is_contingent',
        'flags_is_pending',
        'list_price',
        'price_reduced_amount',
        'primary_photo'
    ];

    public static function getPostals() {
        $postals = DB::table('listings')->select('address_postal_code')->groupBy("address_postal_code")->get();
        return $postals->toArray();
    }
    
    public static function getCities() {
        $cities = DB::table('listings')->select('address_city')->groupBy("address_city")->get();
        return $cities->toArray();
    }
    
    public static function getPropertyDetails($listing) {
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'realty-in-us.p.rapidapi.com',
            'X-RapidAPI-Key' => config('services.rapidapi.key'),
            'content-type' => 'application/json',
            ])->get('https://realty-in-us.p.rapidapi.com/properties/v3/detail?property_id=' . $listing);

        $jd = json_decode($response->getBody(), true);

        if (array_key_exists('errors', $jd)) {
            return 'error';
        }

        $property = $jd['data']['home'];
        $features = [];
        $listDays = date_diff(date_create($property['list_date']), date_create())->format("%a days");

        if (true) array_push($features, ['fa-solid fa-house', 'Single family', 'Property type']);
        if (!is_null($property['list_date'])) array_push($features, ['fa-solid fa-calendar', $listDays, 'Time on Realty56']);
        if (!is_null($property['price_per_sqft'])) array_push($features, ['fa-solid fa-ruler-combined', '$'.$property['price_per_sqft'], 'Price per sqft']);
        if (!is_null($property['flags']['is_garage_present'])) array_push($features, ['fa-solid fa-warehouse', $property['flags']['is_garage_present']." car", 'Garage']);
        if (!is_null($property['description']['year_built'])) array_push($features, ['fa-solid fa-hammer', $property['description']['year_built'], 'Year built']);
        return [$property, $features];

    }

}

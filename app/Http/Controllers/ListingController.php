<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function showAllListings(Request $request) {
        $query = null;
        $cities = ['All Arkansas cities'];
        $request->session()->forget('query');
        $request->session()->forget('thisRegion');

        $favorites = [];
        if (auth()->check()) {
            $favorites = auth()->user()->getFavorites()->pluck('property_id')->toArray();
        }
        $listings=Listing::query();
        $listingCount = $listings->count();
        $listings = $listings->paginate(20);
        return view('home', ['listings' => $listings, 'favorites' => $favorites, 'listingCount' => $listingCount, 'query' => $query, 'cities' => $cities]);
    }

    public function showFavoriteListings() {
        $query = null;
        if (auth()->check()) {
            $favorites = auth()->user()->getFavorites()->pluck('property_id')->toArray();
            $listings = Listing::query()->whereIn('property_id', [...$favorites])->get();
            $listingCount = $listings->count();
            return view('home', ['listings' => $listings, 'favorites' => $favorites, 'userfav' => 1, 'listingCount' => $listingCount, 'query' => $query]);
        }
    }

    public function getCityData() {
        $cities = Listing::getCities();
        return $cities;
    }
    
    public function getPostalData() {
        $postals = Listing::getPostals();
        return $postals;
    }

    public function customListings(Request $request) {
        $input = $request->all();
        $favorites = [];
        $cities = ['All Arkansas cities'];

        if (auth()->check()) {
            $favorites = auth()->user()->getFavorites()->pluck('property_id')->toArray();
        }

        $queryResults = buildQuery($input, $request);

        if ($queryResults == "error") {
            return redirect('/');
        }
        $request->session()->put('query', $input);
        $listingCount = $queryResults->count();
        
        if(array_key_exists("city", $input) || array_key_exists("zip", $input)) {
            $request->session()->put('thisRegion', array_key_exists("city", $input) ? $input['city'] : $input['zip']);
            $cities = array_unique($queryResults->pluck('address_city')->toArray());
        }

        $listings = $queryResults->paginate(20);

        //---------------------------
        $query = session('query');

        return view('home', ['listings' => $listings, 'favorites' => $favorites, 'listingCount' => $listingCount, 'query' => $query, 'cities' => $cities]);
    }

    public function viewSinglelisting($listing) {
        $favorites = [];
        if (auth()->check()) {
            $favorites = auth()->user()->getFavorites()->pluck('property_id')->toArray();
        }

        $property = Listing::getPropertyDetails($listing);

        if ($property == 'error') {
            return redirect('/')->with('failure', 'Property data unavailable - select another property.');
        }
        return view('listing', ['favorites' => $favorites, 'details' => $property[0], 'features' => $property[1]]);
    }
}

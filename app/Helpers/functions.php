<?php

use App\Models\Listing;

function buildQuery($originalRequest, $request) {
    // Take an original query string such as "price=0-100000?beds=1-2"
    // create the correct action (where, whereIn, etc) for the $builder object
    // returns an object ready-to-go for pagination, etc.

    // For converting URL params to database columns
    $lookups = array(
        "price" => "list_price",
        "beds" => "description_beds",
        "baths" => "description_baths",
        "sqft" => "description_sqft",
        "lot" => "description_lot_sqft",
        "city" => "address_city",
        "zip" => "address_postal_code",
        "orderby" 
    );

    $orderBy = array(
        "0" => ['list_price', 'asc'],
        "1" => ['list_price', 'desc'],
        "2" => ['description_lot_sqft', 'asc'],
        "3" => ['description_lot_sqft', 'desc']
    );

    $builder = Listing::query();
    $keepRegion = 0;  
    foreach($originalRequest as $k => $v) {
        if ($k != 'page') {

            if ($k == "orderby") {
                $builder->orderBy($orderBy[$v][0], $orderBy[$v][1]);
            } else {
                if (array_key_exists($k, $lookups)) {

                    // First check for region info
                    if ($k == "city" || $k == "zip") {
                        $keepRegion = 1;
                        $statement = [[$lookups[$k], $v]];
                    } else {
                        // determine if item assignment consists of one or both values,
                        // apply the appropriate function to the query process
                        $range = explode("-", $v);
                        if (!($range[1])) {
                            // only has left-side param
                            $statement = [[$lookups[$k], '>=', ($range[0])]];
                        } elseif (!($range[0])) {
                            // only has right-side param
                            $statement = [[$lookups[$k], '<=', ($range[1])]];
                        } else {
                            // has both params
                            $statement = [[$lookups[$k], '>=', ($range[0])], [$lookups[$k], '<=', ($range[1])]];
                        }
                    }

                    $builder->where($statement);
                } else {
                    return "error";
                }
            }   
        }
    }
    if (!$keepRegion) {
        $request->session()->forget('thisRegion');
    }

    return $builder;
}

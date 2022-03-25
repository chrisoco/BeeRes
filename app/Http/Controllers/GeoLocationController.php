<?php

namespace App\Http\Controllers;

use App\Models\Postcode;
use Illuminate\Support\Facades\Http;

class GeoLocationController extends Controller
{

    /**
     * Get PLZ from Latitude & Longitude.
     *
     * @param float $lat
     * @param float $lon
     * @return Postcode|null
     */
    public static function getPlzFromLatLon(float $lat, float $lon): ?Postcode
    {

        $res = Http::get('https://nominatim.openstreetmap.org/reverse?lat='. $lat .'&lon='. $lon .'&format=json');

        $place = json_decode($res->body());

        // Validate if postcode exists
        if(array_key_exists('address', $place) && array_key_exists('postcode', $place->address)) {

            $postcode_nom = $place->address->postcode;

            $postcode = Postcode::where('postcode', $postcode_nom)->first();

            if($postcode) return $postcode;

        }

        return null;

    }

    /**
     * Generate GoogleMaps URL Pin.
     *
     * @param float $lat
     * @param float $lon
     * @return string
     */
    public static function generateGoogleMapsPin(float $lat, float $lon):string
    {
        return 'https://www.google.com/maps/search/?api=1&query='.$lat.'%2C'.$lon;
    }
}

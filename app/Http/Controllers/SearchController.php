<?php

namespace App\Http\Controllers;

use App\Models\Postcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class SearchController extends Controller
{
    public function searchPLZ(Request $request)
    {
        if($request->search) {

            $data = DB::table('postcodes')->where('postcode','LIKE','%'.$request->search."%")->limit(10)->get();

            return Response($data);

        }

    }
}

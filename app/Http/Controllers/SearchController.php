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

        if($request->input('search')) {

            $column = is_numeric($request->input('search')) ? 'postcode' : 'name';

            $data = DB::table('postcodes')
                ->where($column, 'LIKE', '%' . $request->input('search') . "%")
                ->whereNotIn('id', auth()->user()->beekeeper->postcodes->pluck('id'))
                ->limit(10)->get();

            return Response($data);

        }

        return Response(Postcode::all()->take(10));

    }
}

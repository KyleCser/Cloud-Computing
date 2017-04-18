<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function show($id) 
    {
    	$scorecards = DB::table('scorecards')->where('user_id', $id)->get();
        $results = array();

        if ($scorecards != null) {
            foreach ($scorecards as $key => $value) {
                $result = unserialize($value->{'results'});
                
                array_push($results, $result);
            }
        } else { 
            $results = null;
        }

        return view('stats', compact('results'));
    }
}

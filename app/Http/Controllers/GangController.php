<?php

namespace App\Http\Controllers;

use App\Gang;

use App\Http\Resources\Gang as GangResource;
use App\Http\Resources\GangCollection;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class GangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gangs = $this->queryFilter($request);
        return new GangCollection($gangs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gang = Gang::create($request->all());
        return new GangResource($gang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gang  $gang
     * @return \Illuminate\Http\Response
     */
    public function show(Gang $gang)
    {
        return new GangResource($gang);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gang  $gang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gang $gang)
    {
        $gang_id = $gang->id;
        $gang->delete();

        return $gang_id;
    }


    private function queryFilter(Request $request){
        $gangs = Gang::query();
        

        if($request->has('name')){
            $gangs = DB::select('select * from gangs where name = ?', [$request->name]);
            return $gangs;    
        }

        return $gangs->get();
        
    }
}

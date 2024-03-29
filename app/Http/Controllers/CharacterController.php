<?php

namespace App\Http\Controllers;

use App\Http\Resources\Character as CharacterResource;
use App\Http\Resources\CharacterCollection;

use App\Character;

use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $characters = $this->queryFilter($request);
        return new CharacterCollection($characters->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        return new CharacterResource($character);
    }

    private function queryFilter(Request $request){
        $characters = Character::query();
        
        if($request->has('nationality')){
            $characters->where('nationality', 'ilike', '%'.$request->query('nationality').'%');
        }
        
        if($request->has('gender')){
            $characters->where('gender', $request->query('gender'));
        }
        
        if($request->has('gang')){
            $characters->join('gangs', 'gangs.id', '=', 'characters.gang_id')
                ->select('characters.*')
                ->where('gangs.name', 'like', $request->query('gang').'%')
                ->orderBy('characters.id');
        }
        
        if($request->has('status')){
            $characters->where('status', $request->query('status'));
        }
        
        if($request->has('offset')){
            $characters->offset($request->query('offset'));
        }

        if($request->has('limit')){
            $characters->limit($request->query('limit'));
        }

        return $characters;    
    }
}

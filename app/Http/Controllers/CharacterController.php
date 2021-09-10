<?php

namespace App\Http\Controllers;

use App\Http\Resources\Character as CharacterResource;
use App\Http\Resources\CharacterCollection;

use Illuminate\Support\Facades\DB;

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

    public function store(Request $request){
        DB::insert('insert into characters (name,gang_id,gender,age,status,cause_of_death,date_of_birth,date_of_death,nationality,voiced_by,description,image,artwork) values (?, ?, ?, ?,?,?,?,?,?,?,?,?,?)', 
        [
            $request->has('name') ? $request->name : NULL,
            $request->has('gang_id') ? $request->gang_id : NULL,
            $request->has('gender') ? $request->gender : NULL,
            $request->has('age') ? $request->age : NULL,
            $request->has('status') ? $request->status : NULL,
            $request->has('cause_of_death') ? $request->cause_of_death : NULL,
            $request->has('date_of_birth') ? $request->date_of_birth : NULL,
            $request->has('date_of_death') ? $request->date_of_death : NULL,
            $request->has('nationality') ? $request->nationality : NULL,
            $request->has('voiced_by') ? $request->voiced_by : NULL,
            $request->has('description') ? $request->description : NULL,
            $request->has('image') ? $request->image : NULL,
            $request->has('artwork') ? $request->artwork : NULL
        ]);


        
        $character = DB::select('select * from characters order by id desc limit 1');
        
        return json_encode($character[0]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        $char = DB::select('select * from characters where id = ?', [$character->id]);

        return json_encode($char[0]);
    }

    public function destroy($id){
        $wasDeleted = DB::delete("delete from characters where id = ?", [$id]);
        return ($wasDeleted ? $id : false);
    }

    private function queryFilter(Request $request){
        $characters = Character::query();
        
        if($request->has('nationality')){
            $characters->where('nationality', 'ilike', '%'.$request->query('nationality').'%');
        }
        
        if($request->has('age_less_than')){
            $characters->where('gender', $request->query('gender'));
        }
        
        if($request->has('age')){
            $characters->where('gender', $request->query('gender'));
        }
        
        if($request->has('age_greather_than')){
            $characters->where('gender', $request->query('gender'));
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
            $characters->raw('status like ?', [$request->query('status')]);
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

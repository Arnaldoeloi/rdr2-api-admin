<?php

namespace App\Http\Controllers;

use App\Nickname;
use Illuminate\Http\Request;

use App\Http\Resources\Nickname as NicknameResource;
use App\Http\Resources\NicknameCollection;

use Illuminate\Support\Facades\DB;

class NicknameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $nicknames;

        if($request->has('name')){
            $nicknames = DB::select("SELECT nickname FROM nicknames INNER JOIN characters ON nicknames.character_id = characters.id WHERE characters.name like ?", [$request->query('name')]);
        }else{
            $nicknames = DB::select("SELECT * FROM nicknames");
        }


        return json_encode($nicknames);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nickname  $nickname
     * @return \Illuminate\Http\Response
     */
    public function show(Nickname $nickname)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nickname  $nickname
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nickname $nickname)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nickname  $nickname
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nickname $nickname)
    {
        //
    }
}

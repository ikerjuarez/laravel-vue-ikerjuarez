<?php

namespace App\Http\Controllers;

use App\Models\Joc;
use Illuminate\Http\Request;

class JocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return Joc::all();
        }else{
            return view('home');
        }
    }

    public function view(){
        return view('game.game');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $joc = new Joc();
        $joc->name = $request->name;
        $joc->duration = $request->duration;
        $joc->room_id = $request->room_id;
        $joc->save();

        return $joc;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $joc = Joc::find($id);
        $joc->name = $request['name'];
        $joc->duration = $request['duration'];
        $joc->room_id = $request['room_id'];
        $joc->save();
        return $joc;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $joc = Joc::find($id);
        $joc->delete();
    }
}

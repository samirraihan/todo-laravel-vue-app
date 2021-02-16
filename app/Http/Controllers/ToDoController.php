<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
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
        $data = array();
        $data['name'] = $request->name;
        $data['status'] = '1';
        $insert = DB::table('tasks')->insert($data);
    }

    /**
     * Display the all resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return response()->json([
            'showtasks' => DB::table('tasks as ta')
                ->join('status as st', 'ta.status', '=', 'st.id')
                ->select('ta.*', 'st.name as statusname')
                ->orderby('ta.id', 'desc')
                ->get()
        ]);
    }

    public function counttask(){
        return response()->json([
            'counttask' => DB::table('tasks')->count()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByStatus($id)
    {
        return response()->json([
            'showbystatus' => DB::table('tasks as ta')
                ->join('status as st', 'ta.status', '=', 'st.id')
                ->select('ta.*', 'st.name as statusname')
                ->where('ta.status', $id)
                ->orderby('ta.id', 'desc')
                ->get()
        ]);
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
    public function updatebyid(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->editname;

        $update = DB::table('tasks')->where('id', $id)->update($data);
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
        $data = array();
        $data['status'] = 2;

        $update = DB::table('tasks')->where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('tasks')->where('id', $id)->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCompleted()
    {
        $delete = DB::table('tasks')->where('status', 2)->delete();
    }
}

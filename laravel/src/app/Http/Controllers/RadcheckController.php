<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radcheck;
use Illuminate\Support\Facades\DB;

class RadcheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $radcheck = Radcheck::create($request->all());
        
        if ($radcheck) {
            $res['error'] = false;
            $res['data'] = $radcheck;
            return response()->json($res);
        } else {
            $res['error'] = true;
            $res['data'] = "Some error!";
            return response()->json($res);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $radcheck = Radcheck::find($id);
        return response()->json($radcheck);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $radcheck = Radcheck::find($id);
        $radcheck->update($request->all());
        return response()->json($radcheck);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /** get_email_login guest */
    public function get_email_users(Request $request)
    {
        $emailusers = Radcheck::select('username')->search($request->search)->where('attribute','Cleartext-Password')->where('username','LIKE','%@%')->groupby('username')->paginate(8);
        return view('hotspot.userguest',compact('emailusers'));
    }

    /** export csv file */
    public function export_email_users()
    {
        //$emailusers = Radcheck::select('username')->where('attribute','Cleartext-Password')->where('username','LIKE','%@%')->groupby('username')->get();
        $emailusers = DB::select("SELECT @rownum:=@rownum+1 no, username AS email FROM radcheck, (SELECT @rownum:=0) r WHERE attribute='Cleartext-Password' AND username LIKE '%@%' GROUP BY username");
        return response()->json($emailusers,200);
    }

}

<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use App\Master_kursx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Master_kursx::select(['id','currency','value','selling_rate','buying_rate','last_update']);
        if ($request->ajax()) {
            //$data = Company::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data) {
                        return '<button type="button" class="btn btn-default btn-sm" id="getDetailUserData" data-id="'.$data->id.'">Detail</button>
                            <button type="button" class="btn btn-success btn-sm" id="getEditUserData" data-id="'.$data->id.'">Edit</button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('kurs',compact('data'));
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
    public function store(Request $request, Master_kursx $master_kurs)
    {
        $validator = \Validator::make($request->all(), [
            'currency' => 'required',
            'value' => 'required',
            'selling_rate' => 'required',
            'buying_rate' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        DB::beginTransaction();

        try{

        $sellkursUSD = 14396;
        $buykursUSD = 14100;
        $master_kurs->currency = $request->currency;
        $master_kurs->value = $request->value;
        //$master_kurs->selling_rate = $request->selling_rate;
        //$master_kurs->buying_rate = $request->buying_rate;
        $master_kurs->last_update = date('d F Y');

        if ($request->currency == 'LKR'){
            //selling conversion
            $LKRTOUSD = (1/$request->selling_rate);
            $USDTOIDR = $LKRTOUSD * $sellkursUSD;
            //buying conversion
            $_LKRTOUSD = (1/$request->buying_rate);
            $_USDTOIDR = $_LKRTOUSD * $buykursUSD;


            $master_kurs->selling_rate =  $USDTOIDR;
            $master_kurs->buying_rate = $_USDTOIDR;
        }else{
            $master_kurs->selling_rate = $request->selling_rate;
            $master_kurs->buying_rate = $request->buying_rate;
        }
        $master_kurs->save();

        DB::commit();

        return response()->json(['info'=>'Rate added successfully']);

        }catch(\Exception $e){
        DB::rollback();
        //return response()->json(['info'=>'Something went wrong']);
        return response()->json(['info'=>$e->getMessage()]);
        //return $e->getMessage();
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

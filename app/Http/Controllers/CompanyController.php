<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Company;
use App\Rules\FQDN;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Company::select(['id','name','email','website','address','phone_number']);
        if ($request->ajax()) {
            //$data = Company::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data) {
                        return '<button type="button" class="btn btn-default btn-sm" id="getDetailUserData" data-id="'.$data->id.'">Detail</button>
                            <button type="button" class="btn btn-success btn-sm" id="getEditUserData" data-id="'.$data->id.'">Edit</button>
                            <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteUserModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('company',compact('data'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Company $company)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:companies,email',
            'website' => new FQDN(),
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        DB::beginTransaction();

        try{
        $company->name = $request->namex;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->address = $request->address;
        $company->phone_number = $request->phone_number;
        $company->save();

        DB::commit();

        return response()->json(['info'=>'Company added successfully']);

        }catch(\Exception $e){
        DB::rollback();
        //return response()->json(['info'=>'Something went wrong']);
        return response()->json(['info'=>$e->getMessage()]);
        //return $e->getMessage();
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = new Company;
        $data = $company->findData($id);

        $html = '<div class="form-group">
                    <label for="Item">Name:</label>
                    <input type="text" class="form-control" name="name" id="editName" value="'.$data->name.'">
                </div>
                <div class="form-group">
                    <label for="Item">Email:</label>
                    <input type="email" class="form-control" name="email" id="editEmail" value="'.$data->email.'">
                </div>
                <div class="form-group">
                    <label for="Item">Website:</label>
                    <input type="text" class="form-control" name="website" id="editWebsite" value="'.$data->website.'">
                </div>
                <div class="form-group">
                    <label for="Item">Address:</label>
                    <input type="text" class="form-control" name="address" id="editAddress" value="'.$data->address.'">
                </div>
                <div class="form-group">
                    <label for="Item">Phone:</label>
                    <input type="text" class="form-control" name="phone_number" id="editPhone" value="'.$data->phone_number.'">
                </div>

                  ';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:companies,email,'.$id,
            'website' => new FQDN(),
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->address = $request->address;
        $company->phone_number = $request->phone_number;
        $company->save();

        return response()->json(['success'=>'Company updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = new Company;
        $company->deleteData($id);

        return response()->json(['success'=>'Company deleted successfully']);
    }

       /**
    * Show the application dataAjax.
    *
    * @return \Illuminate\Http\Response
    */
    public function getCompanies(Request $request){

        $search = $request->search;

        if($search == ''){
           $companies = Company::orderby('name','asc')->select('id','name')->limit(5)->get();
        }else{
           $companies = Company::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($companies as $company){
           $response[] = array(
                "id"=>$company->id,
                "text"=>$company->name
           );
        }

        return response()->json($response);
     }

       /**
     * Show the form for viewing the specified resource.
     */
    public function show($id)
    {
        $company = new Company;
        $data = $company->findData($id);

        return response()->json([ 'company' => $data]);
    }
}

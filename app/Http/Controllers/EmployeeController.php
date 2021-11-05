<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Employee;

class EmployeeController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //$data = Employee::latest()->get();
            $data = Employee::select(['id','name','email','phone_number','photo','address','company_id'])->with(['company']);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        return '<img src="'.$data->photo.'" border="0" width="50" class="img-rounded" align="center" />';})
                    ->addColumn('action', function($data) {
                        return '<button type="button" class="btn btn-default btn-sm" id="getDetailUserData" data-id="'.$data->id.'">Detail</button>
                        <button type="button" class="btn btn-success btn-sm" id="getEditUserData" data-id="'.$data->id.'">Edit</button>
                            <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteUserModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
        }
      
        return view('employee',compact('employees'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Employee $employee)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone_number' => 'required',
            'address' => 'required',
            'photo' => 'required|url',
            'company_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_number = $request->phone_number;
        $employee->address = $request->address;
        $employee->photo = $request->photo;
        $employee->company_id = $request->company_id;
        $employee->save();

        return response()->json(['success'=>'Employee added successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = new Employee;
        $data = $employee->findData($id);
     
        $company = Employee::find($id)->company;


        $html = '<div class="form-group">
                    <label for="Item">Name:</label>
                    <input type="text" class="form-control" name="name" id="editName" value="'.$data->name.'">
                </div>
                <div class="form-group">
                    <label for="Item">Email:</label>
                    <input type="email" class="form-control" name="email" id="editEmail" value="'.$data->email.'">
                </div>
                <div class="form-group">
                    <label for="Item">Phone:</label>
                    <input type="text" class="form-control" name="phone_number" id="editPhone" value="'.$data->phone_number.'">
                </div>
                <div class="form-group">
                    <label for="Item">Address:</label>
                    <input type="text" class="form-control" name="address" id="editAddress" value="'.$data->address.'">
                </div>
                <div class="form-group">
                    <label for="Item">Photo url:</label>
                    <input type="url" class="form-control" name="photo" id="editPhoto" value="'.$data->photo.'">
                </div>
                <div class="form-group">
                <label for="name">Company:</label>
                        <select class="itemNamex form-control" name="company_id"  id="editCompany" style="width:465px" >
                        <option value="'.$company->id.'">'.$company->name.'</option>
                </select>
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
            'email' => 'required|email|unique:employees,email,'.$id,
            'phone_number' => 'required',
            'address' => 'required',
            'photo' => 'required|url',
            'company_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_number = $request->phone_number;
        $employee->address = $request->address;
        $employee->photo = $request->photo;
        $employee->company_id = $request->company_id;
        $employee->save();
   

        return response()->json(['success'=>'Employee updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = new Employee;
        $employee->deleteData($id);

        return response()->json(['success'=>'Employee deleted successfully']);
    }

    
}

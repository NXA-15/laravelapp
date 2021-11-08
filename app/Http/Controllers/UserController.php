<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::select(['id','name','email']);
        if ($request->ajax()) {
            //$data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data) {
                        return '<button type="button" class="btn btn-success btn-sm" id="getEditUserData" data-id="'.$data->id.'">Edit</button>
                            <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteUserModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('user',compact('data'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        //$user->storeData($request->all());
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) $user->password =  bcrypt($request->password);
        $user->save();

        return response()->json(['success'=>'User added successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = new User;
        $data = $user->findData($id);

        $html = '<div class="form-group">
                    <label for="Item">Name:</label>
                    <input type="text" class="form-control" name="name" id="editName" value="'.$data->name.'">
                </div>
                <div class="form-group">
                    <label for="Item">Email:</label>
                    <input type="email" class="form-control" name="email" id="editEmail" value="'.$data->email.'">
                </div>

                <div class="form-group">
                <label for="password">Password:</label>
                <input type="password"   class="form-control" placeholder="Password" id="editPassword" name="password" autocomplete="new-password">
                </div>';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['success'=>'User updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = new User;
        $user->deleteData($id);

        return response()->json(['success'=>'User deleted successfully']);
    }

}

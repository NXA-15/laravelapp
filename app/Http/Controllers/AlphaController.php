<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlphaController extends Controller
{
    public function index(Request $request)
    {
        return view('alpha');
    }

    public function getAllPost(){
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'usertestkey' => 'test321',
                'passtestkey' => 'passTest123'
            ]
        ]);
        $request = $client->get('https://alpha.brokr.id/tester/index');
        $response = $request->getBody()->getContents();

        return (['data' => json_decode($response) ]);
    }

    public function getPostById(Request $request){
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'usertestkey' => 'test321',
                'passtestkey' => 'passTest123'
            ]
        ]);
        $post = $client->get('https://alpha.brokr.id/tester/' . $request->id . '/show');
        $response = $post->getBody()->getContents();

        return  (['alphax' => json_decode($response) ]);
    }

    public function addPost(Request $request){
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'usertestkey' => 'test321',
                'passtestkey' => 'passTest123'
            ]
        ]);

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $post = $client->post('https://alpha.brokr.id/tester/store', [
            'form_params' => [
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
            ]
        ]);

        if ( $post->getStatusCode() == 201 ) { 
            return 'Data added successfully';
        }
    }
}

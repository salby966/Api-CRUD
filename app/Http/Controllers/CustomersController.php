<?php

namespace App\Http\Controllers;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customers::all();
        $response = array('response'=>["message"=>"","data"=>$customers],'success'=>true);
        return Response::json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $rules = [
            'FirstName'=>'required',
            'LastName'=>'required',
            'City'=>'required',
            'Country'=>'required',
            'Phone'=>'required|numeric'
        ];

        $response = array('response'=>'','success'=>false);
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $response['response'] = $validator->message();
        }else{
            $customers = new Customers([
                'FirstName' => $request->get('FirstName'),
                'LastName' => $request->get('LastName'),
                'City' => $request->get('City'),
                'Country' => $request->get('Country'),
                'Phone' => $request->get('Phone')
            ]);

            $customers->save();
            $response['response'] = ["message"=> "The Customer has been created successfully","data"=>$customers];
            $response['success']= true;
        }

        return Response::json($response, 201);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $response = array('response'=>'','success'=>false);
        $existingCustomer = Customers::find($id);
        if(!$existingCustomer instanceof Customers){
            $response['response'] = 'The customer cannot be found.';
            return Response::json($response, 200);
        }
        $existingCustomer->Customers;
        $response['response'] = ["message"=>"","data"=>$existingCustomer];
        $response['success'] = true;

        return Response::json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
         $rules = [
            'FirstName'=>'required',
            'LastName'=>'required',
            'City'=>'required',
            'Country'=>'required',
            'Phone'=>'required|numeric'
        ];

        $response = array('response'=>'','success'=>false);
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $response['response'] = $validator->messages();
        }else{
            $existingCustomer = Customers::find($id);
            if(!$existingCustomer instanceof Customers){
                $response['response'] = 'The Customer cannot be found.';
                return Response::json($response, 200);
            }

            $updatedCustomer = $existingCustomer->update($request->all());
            $response['response'] = ["message"=> "The customer has been updated successfully", "data"=>$existingCustomer];
            $response['success'] = true;
        }   
        return Response::json($response,200);
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
   public function delete($id)
    {
        $response = array('response'=>'','success'=>false);
        $existingCustomer = Customers::find($id);
        if(!$existingCustomer instanceof Customers){
            $response['response'] = 'The customer cannot be found.';
            return Response::json($response, 200);
        }
        $existingCustomer = Customers::find($id);
        $existingCustomer->delete();
        
           $response = [
                'success' => true,
                'messages' => 'The customer has been deleted.',
           ];

        return Response::json($response, 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Orders::join('customers','customers.id', '=','orders.CustomerId')->get(['orders.*','customers.id']);
        $response = array('response'=>["message"=>"","data"=>$order],'success'=>true);
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
            'OrderDate'=>'required',
            'CustomerId'=>'required',
            'TotalAmount'=>'required',
        ];

        $response = array('response'=>'','success'=>false);
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $response['response'] = $validator->messages();
        }else{
            $order = new Orders([
                'OrderDate' => $request->get('OrderDate'),
                'CustomerId' => $request->get('CustomerId'),
                'TotalAmount' => $request->get('TotalAmount')
            ]);

            $order->save();
            $response['response'] = ["messages"=> "The order has been created successfully","data"=>$order];
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
        $existingOrder = Orders::find($id);
        if(!$existingOrder instanceof Orders){
            $response['response'] = 'The order cannot be found.';
            return Response::json($response, 200);
        }
        $existingOrder->Orders;
        $response['response'] = ["message"=>"", "data"=>$existingOrder];
        $response['success']= true;

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
            'OrderDate'=>'required',
            'CustomerId'=>'required',
            'TotalAmount'=>'required',
        ];

        $response = array('response'=>'','success'=>false);
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $response['response'] = $validator->message();
        }else{
              $existingOrder = Orders::find($id);
                if(!$existingOrder instanceof Orders){
                    $response['response'] = 'The order cannot be found.';
                    return Response::json($response, 200);
                }

                $updateOrder = $existingOrder->update($request->all());
                $response['response'] = ["message"=> "The order has been updated successfully", "data"=>$existingOrder];
                $response['success'] = true;
            }

            return Response::json($response, 200);
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
        $existingOrder = Orders::find($id);
        if(!$existingOrder instanceof Orders){
            $response['response'] = 'The order cannot be found.';
            return Response::json($response, 200);
        }
        $existingOrder = Orders::find($id);
        $existingOrder->delete();
        
           $response = [
                'success' => true,
                'messages' => 'The order has been deleted.',
           ];

        return Response::json($response, 200);
    }
}

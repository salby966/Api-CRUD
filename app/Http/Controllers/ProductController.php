<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::all();
        $response = array('response'=>["message"=>"", "data"=>$product], 'success'=> true);
        return Response::json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $rules = [
            'ProductName'=>'required',
            'UnitPrice'=>'required',
            'Package'=>'required'
        ];

        $response = array('response'=>'','success'=>false);
        $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                $response['response'] = $validator->messages();
            }else{
                $product = new Product([
                    'ProductName' => $request->get('ProductName'),
                    'UnitPrice' => $request->get('UnitPrice'),
                    'Package' => $request->get('Package')
                ]);

                $product->save();
                $response['response'] = ["message"=> "The Product has been created success","data"=>$product];
                $response['success'] = true;
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
        $existingProduct = Product::find($id);
        if(!$existingProduct instanceof Product){
            $response['response'] = 'The product cannot be found.';
            return Response::json($response, 200);
        }
        $existingProduct->Product;
        $response['response'] = ["message"=>"", "data"=>$existingProduct];
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
            'ProductName'=>'required',
            'UnitPrice'=>'required',
            'Package'=>'required'
        ];

        $response = array('response'=>'','success'=>false);
        $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                $response['response'] = $validator->messages();
            }else{
                $existingProduct = Product::find($id);
                if(!$existingProduct instanceof Product){
                    $response['response'] = 'The product cannot be found.';
                    return Response::json($response, 200);
                }

                $updateProduct = $existingProduct->update($request->all());
                $response['response'] = ["message"=> "The product has been updated successfully", "data"=>$existingProduct];
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
        $existingProduct = Product::find($id);
        if(!$existingProduct instanceof Product){
            $response['response'] = 'The product cannot be found.';
            return Response::json($response, 200);
        }
        $existingProduct = Product::find($id);
        $existingProduct->delete();
        
           $response = [
                'success' => true,
                'messages' => 'The product has been deleted.',
           ];

        return Response::json($response, 200);
    }
}

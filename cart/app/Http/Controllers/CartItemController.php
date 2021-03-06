<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $form = $request->all();
        $message = [
            'required' => ':attribute 是必要的',
            'between'   =>':attribute 的輸入 :input 不在 :min 跟:max之間'
        ];
        $vilidator = Validator::make($form,[
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity'  => 'required|integer|between:1,10'
        ],$message);
        if($vilidator->fails()){
            return response($vilidator->errors(),400);
        }
        $vilidatorDate = $vilidator->validated();  //取得驗證通過Data

        DB::table('cart_items')->insert(['cart_id' => $form['cart_id'],
                                        'product_id'=>$form['product_id'],
                                        'quantity'  =>$form['quantity'],
                                        'created_at'=> now(),
                                        'updated_at'=> now()
                                    ]);
        return response()->json('success',200);
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
        $form = $request->all();
        DB::table('cart_items')->where('id',$id)
                                ->update(['quantity'      => $form['quantity'],
                                          'updated_at'    =>  now()
                                        ]);
        return response()->json('success',200);
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
        DB::table('cart_items')->where('id', $id)
                                ->delete();
                                
        return response()->json("success",200);

    }
}

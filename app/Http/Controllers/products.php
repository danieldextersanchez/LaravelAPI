<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class products extends Controller
{
    public function index(){
        return DB::table('products')->get();
    }
    public function put($data){   
        try{
            DB::table('admin')->insert(
                [
                    'product_name' => $request->product_name,
                    'brand' => bcrypt($request->brand), 
                    'price' => $request->price,
                    'created_at'  => $current_time = Carbon::now()->toDateTimeString(),
                    'updated_at'  => $current_time = Carbon::now()->toDateTimeString()
                ]
            );
            return "Added";  
        }catch(\Illuminate\Database\QueryException $ex){
            return $ex->getMessage();
        }        
            
              
    }
}

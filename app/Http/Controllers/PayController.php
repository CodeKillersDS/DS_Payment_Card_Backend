<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayCard;
use Validator;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class PayController extends Controller
{
    //get method
    // function list()
    // {
    //     //if not in id then give all
    //     $paycard = PayCard::all();
    //     return response()->json( $paycard );
    // }


    //add method
                //get data from request
    function add(Request $request)
    {
        //set rules
        $rules = array (

            "email" => "required",
            "phoneNum" => "required | min:9 | max:9",
            "name" => "required",
            "cardNum" => "required | min:12 | max:12",
            "cvv" => "required | min:3 | max:3",
            "amount" => "required"

        );

                                    //pass request    //pass rules
        $validator = Validator::make($request->all() , $rules);

        if($validator -> fails())
        {
            return response() -> json($validator->errors() , 401);
        }
        else
        {        
            $paycard = new PayCard;

            //add columns
            $paycard -> email = $request -> email;
            $paycard -> phoneNum = $request -> phoneNum;
            $paycard -> name = $request -> name;
            $paycard -> cardNum = $request -> cardNum;
            $paycard -> cvv = $request -> cvv;
            $paycard -> amount = $request -> amount;

            //save
            $result = $paycard -> save();

           // return response()->json($paycard);

            //save condition
            if($result)
            {

                $details = [
                    'title' => 'Mail From Sunshine',
                    'body' => 'Your Payment Success',
                    'phone' => $request -> phoneNum,
                    'name' => $request -> name,
                    'amount' => $request -> amount
                ];
        
                $mailDone = Mail::to($request -> email)->send(new TestMail($details));


                $Nexmo = app('Nexmo\Client');
                $Nexmo->message()->send([
                    'to' => '+94'.(int)$request -> phoneNum,
                    'from' => 'Sun-Shine',
                    'text' => 'Dear '.$request -> name.', Your Payment '.$request -> amount.' Successfully Claimed.',
                ]);
        
                if($Nexmo)
                {
                    return ["Result" => "Data Added Successfully"];
                }
                else
                {
                    return ["Result" => "Data Added Unsuccessfully"];
                }
                
                //return "Email Sent";
                
            }
            else
            {
                return ["Result" => "Data Can't Added"];
            }
    }

        
    }

    // //put method
    // function update(Request $request)
    // {
    //     //find with id
    //     $paycard = PayCard::find($request -> id);

    //     //get with request
    //     $paycard -> email = $request -> email;
    //     $paycard -> phoneNum = $request -> phoneNum;
    //     $paycard -> name = $request -> name;
    //     $paycard -> cardNum = $request -> cardNum;
    //     $paycard -> cvv = $request -> cvv;
    //     $paycard -> amount = $request -> amount;

    //     //save
    //     $result = $paycard -> save();

    //     //update condition
    //     if($result)
    //     {
    //         return ["Result" => "Data Updated Successfully"];
    //     }
    //     else
    //     {
    //         return ["Result" => "Data Can't Updated"];
    //     }
    // }

    // //search method
    // function search($name)
    // {
    //     //search all
    //     return PayCard::where("name" , $name) -> get();
    // }

    // //delete method
    // function delete($id)
    // {
    //     //find specific id
    //     $paycard = PayCard::find($id);

    //     //delete
    //     $result = $paycard -> delete();

    //     if($result)
    //     {
    //         return ["Result" => "Data Deleted Successfully"];
    //     }
    //     else
    //     {
    //         return ["Result" => "Data Can't Deleted"];
    //     }
    // }

}

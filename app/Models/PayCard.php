<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayCard extends Model
{
    use HasFactory;

    //values as null
    public $timestamps = false;

    protected $table = "pay_cards";

    protected $fillable = ["email" , "phoneNum" , "name" , "cardNum" , "cvv" , "amount"];
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TestController extends Controller
{
    public function tokencrypt($id){
        if($id){
            return Crypt::decryptString($id);
        }else{
           return Crypt::encryptString('123445');
        }
    }

}

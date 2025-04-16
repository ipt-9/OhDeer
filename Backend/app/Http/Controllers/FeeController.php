<?php

namespace App\Http\Controllers;


use App\Models\Fee;
use http\Message;
use Illuminate\Http\Request;

class FeeController extends Controller
{
        public function getFee()
        {
            return Fee::findOrFail(1);
        }
}

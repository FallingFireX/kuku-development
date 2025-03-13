<?php

namespace App\Http\Controllers;

class CustomController extends Controller {
    public function getCalculator() {
        return view('calculator.calculator');
    }
}

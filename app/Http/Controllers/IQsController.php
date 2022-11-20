<?php

namespace App\Http\Controllers;

use App\Traits\FactorsTrait;
use Illuminate\Http\Request;

class IQsController extends Controller
{
    use FactorsTrait;

    public function countNumbersWithoutFive(Request $request) : int {
        $count = 0;
        $start = (int) $request->input('startNumber');
        $end = (int) $request->input('endNumber');
        $num = $start;
        while( $num <= $end){
            $numString = strval($num);
            if(!str_contains($numString, "5")){
                $count ++;
            }
            $num++;
        }
        return $count;
    }

    public function evaluateString(Request $request) : int {
        $sum = 0;
        $keys = range("A","Z");
        $values = range(1,26);
        $key_values = array_combine($keys, $values);
        $str = $request->input('str');
        $characters = array_reverse(str_split($str));
        foreach ($characters as $i => $ch){
            $sum += $key_values[$ch] * ($key_values["Z"] ** $i);
        }
        return $sum;
    }

    public function leastNumberOfSteps(Request $request) : array {
        $q = $request->input('q');
        $result = [];
        foreach ($q as $x){
            $steps = 0;
            while($x){
                $b =  $this->findGreatestOfTwoFactorsWithLeastDiff($x);
                if($b != 1 && $b < $x){
                    $x = $b;
                }else{
                    $x--;
                }
                $steps++;
            }
            $result[] = $steps;
        }
        return $result;
    }
}

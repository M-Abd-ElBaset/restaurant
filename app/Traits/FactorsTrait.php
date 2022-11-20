<?php

namespace App\Traits;

trait FactorsTrait
{
    // Function to find the laragest of  the two factors with least difference
    public function findGreatestOfTwoFactorsWithLeastDiff($x) : int
    {
        $ans = -1;
        $difference = PHP_INT_MAX;

        for ($i = 1; $i <= sqrt($x); $i++)
        {
            $a = $i;
            if($x % $a == 0){
                $b = $x / $a;
                if(abs($b - $a) < $difference ){
                    $difference = $b - $a;
                    $ans = $b;
                }else{
                    break;
                }
            }
        }
        return $ans;
    }
}

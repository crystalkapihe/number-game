<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class FactorsComponent extends Component
{
    public function compare($number, $guess)
    {
        return ($number == $guess) ? [true, "The number is $number"] : (
        !($number % $guess) ? [false, "$guess is a factor of the number", ] : (
        !($guess % $number) ? [false, "$guess is a multiple of the number"] :
            [
                false,
                "$guess shares " .
                ($count = count(array_intersect($this->factor($number), $this->factor($guess)))) .
                ($count == 1 ? ' factor' : ' factors') .
                ' with the number',
                $count
            ]
        ));

    }

    public function factor($value, $arr = true)
    {
        $factors = $arr ? [1, $value] : 2;
        for ($i = 2; $i <= sqrt(abs($value)); $i++) {
            if (!($value % $i)) {
                if ($arr) {
                    $j = $value / $i;
                    $factors[] = $i;
                    if ($i != $j) {
                        $factors[] = $j;
                    }
                } else {
                    $factors += ($i * $i == $value) ? 1 : 2;
                }
            }
        }
        return $factors;
    }
}
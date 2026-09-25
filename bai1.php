<?php

function isPrime($number)
{
    if ($number < 2) {
        return false;
    }

    for ($i = 2; $i < $number; $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }

    return true;
}

echo "Các số nguyên tố từ 1 đến 100: ";

for ($i = 1; $i <= 100; $i++) {
    if (isPrime($i)) {
        echo $i . " ";
    }
}

?>
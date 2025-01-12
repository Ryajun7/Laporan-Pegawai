<?php

namespace App\Services;

class HelloService
{
    public function helloworld($n)
    {
        $output = "";
        for ($i = 1; $i <= $n; $i++) {
            $value = $i;

            if ($i % 4 == 0 && $i % 5 == 0) {
                $value = "helloworld";
            } elseif ($i % 4 == 0) {
                $value = "hello";
            } elseif ($i % 5 == 0) {
                $value = "world";
            }

            $output .= $value . " ";
        }

        return trim($output);
    }
}

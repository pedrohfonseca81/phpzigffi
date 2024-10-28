<?php

namespace PhpZigFFI\Tests\Benchmark;

class Iterate1000000TimesBenchWithWhile
{
    
    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchConsume()
    {
        $i = 0;
        $value = 0;
        while ($i < 1000000) {
            $i++;
            $value += $i;
        }
    }
}
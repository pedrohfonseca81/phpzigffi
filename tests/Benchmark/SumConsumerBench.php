<?php

namespace PhpZigFFI\Tests\Benchmark;

use PhpZigFFI\Tests\Math;

class SumConsumerBench
{
    
    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchConsume()
    {
        $math = new Math;

        $math->add(5, 5);
    }
}

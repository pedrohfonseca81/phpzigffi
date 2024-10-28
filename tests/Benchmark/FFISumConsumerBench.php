<?php

namespace PhpZigFFI\Tests\Benchmark;

use PhpZigFFI\Tests\RootFFI;

class FFISumConsumerBench
{
    
    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchConsume()
    {
        $root = new RootFFI;

        $root->add(5, 5);
    }
}

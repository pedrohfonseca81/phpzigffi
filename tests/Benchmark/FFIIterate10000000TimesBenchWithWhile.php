<?php

namespace PhpZigFFI\Tests\Benchmark;

use PhpZigFFI\Tests\RootFFI;

class FFIIterate10000000TimesBenchWithWhile
{
    
    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchConsume()
    {
        $root = new RootFFI;

        $root->iterate_with_while(10000000);
    }
}

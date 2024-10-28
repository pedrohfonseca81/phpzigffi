<?php

namespace PhpZigFFI\Tests;

use CDef;
use FFI\CData;
use PhpZigFFI\Traits\WithFFI;
use PhpZigFFI\Types\CList;

class RootFFI
{
    use WithFFI;

    public $libPath = __DIR__ . '/../zig_src/zig-out/lib/libpackage.so';

    #[CDef]
    public function add(int $a, int $b): int
    {
        return $this->callFunction(__METHOD__, func_get_args());
    }

    #[CDef]
    public function iterate_with_while(int $times): int
    {
        return $this->callFunction(__METHOD__, func_get_args());
    }

    #[CDef(CList::class)]
    public function get_array(): CData
    {
        return $this->callFunction(__METHOD__, func_get_args());
    }
}

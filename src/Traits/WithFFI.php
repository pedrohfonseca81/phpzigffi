<?php

namespace PhpZigFFI\Traits;

use Exception;
use FFI;
use ReflectionClass;
use ReflectionMethod;
use PhpZigFFI\Util\CreateCDefCode;

trait WithFFI
{
    public FFI $ffi;

    public function callFunction($method, $args)
    {
        $reflectionMethod = new ReflectionMethod($method);

        $methodName = $reflectionMethod->getName();

        return $this->ffi->{$methodName}(...$args);
    }

    public function __construct()
    {
        $ffiEnable = ini_get("ffi.enable");

        if (!$ffiEnable or $ffiEnable == "preload") {
            throw new Exception("FFI extension is not enabled. Please enable it in your php.ini file.");
        }

        $ffiReflectionClass = new ReflectionClass($this);

        $ffiCode = (new CreateCDefCode)->createCode($ffiReflectionClass);

        $this->ffi = FFI::cdef(
            $ffiCode,
            $this->libPath
        );
    }
}

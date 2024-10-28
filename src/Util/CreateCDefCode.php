<?php

namespace PhpZigFFI\Util;

use CDef;
use ReflectionClass;

class CreateCDefCode
{
    public function getDefaultCode(): string
    {
        return <<<C
            typedef struct {
                const int* ptr;
                size_t len;
            } CList;
        C;
    }

    public function createCode(ReflectionClass $ffiReflectionClass): string
    {
        $methods = $ffiReflectionClass->getMethods();
        $cdefMethods = array_filter($methods, function ($method) {
            $attributes = $method->getAttributes();

            return array_filter($attributes, function ($attribute) {
                return $attribute->getName() === CDef::class;
            });
        });

        $cdefMethodsString = join('', array_map(function ($method) {
            $name = $method->getName();
            $returnType = $method->getReturnType();
            $attributes = $method->getAttributes();

            $cdefAttribute = array_filter($attributes, function ($attribute) {
                return $attribute->getName() === CDef::class;
            })[0];

            $cdefArguments = $cdefAttribute->getArguments();

            if (!$returnType) throw new \Exception("Return type is required for method $name");

            $returnTypeName = $returnType->getName();

            if (count($cdefArguments) > 0) $returnTypeName = $this->getCustomType($cdefArguments[0]);

            $parameters = $method->getParameters();
            $parametersString = join(', ', array_map(function ($parameter) {
                return $parameter->getType()->getName() . ' ' . $parameter->getName();
            }, $parameters));

            return "$returnTypeName $name($parametersString);";
        }, $cdefMethods));

        return $this->getDefaultCode() . $cdefMethodsString;
    }

    public function getCustomType($class)
    {
        return match ($class) {
            \PhpZigFFI\Types\CList::class => 'CList',
            default => throw new \Exception("Unknown type $class"),
        };
    }
}

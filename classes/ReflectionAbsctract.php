<?php

abstract class ReflectionAbsctract
{
    public static function getArgs(mixed $scoped, mixed $attr, string $method)
    {
        $reclation = new ReflectionMethod($scoped, $method);
        $attributes = $reclation->getAttributes($attr);

        return (object)$attributes[0]->newInstance();
    }
}

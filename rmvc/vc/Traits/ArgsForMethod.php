<?php

namespace rmvc\vc\Traits;

use rmvc\vc\Interfaces\StorageInterface;

trait ArgsForMethod
{

    /**
     * @param array $args
     * @return array
     */
    public function argsForMethod(string $className, string $methodName, StorageInterface $storage)
    {
        $method = new \ReflectionMethod($className, $methodName);

        $parametersForMethod = [];

        foreach ($method->getParameters() as $param) {
            $type = $param->getType();
            if ($type instanceof \ReflectionNamedType) {

                $class = new ($type->getName())();

                if ($storage::has($type->getName())) {
                    $parametersForMethod [$param->getName()] = $storage::get($type->getName());
                    return $parametersForMethod;
                } else {
                    foreach ($storage::getAll() as $service){
                        if ($class instanceof $service){
                            $parametersForMethod [$param->getName()] = $class;
                            return $parametersForMethod;
                        }
                    }
                }
            }
        }
    }
}
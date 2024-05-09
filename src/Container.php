<?php

declare(strict_types= 1);

namespace App;

use Closure;

class Container {

    private array $registry = [];

    public function set(string $className, Closure $closure): void {
        $this->registry[$className] = $closure;
    }

    public function get(string $className): object {

        if(array_key_exists($className, $this->registry)) {
            return $this->registry[$className]();
        }

        $classReflection = new \ReflectionClass($className);
        
        if(!$classReflection->isInstantiable()) {
            throw new \Exception("Class {$className} can not have instanse");
        }

        if(!$classReflection->getConstructor()) {
            return new $className;    
        }

        $constatuctorParams = $classReflection->getConstructor()->getParameters();
        $depedencies = [];

        foreach ($constatuctorParams as $constatuctorParam) {
            $type = $constatuctorParam->getType();
            $depedencies[] = $this->get((string) $type);
        }

        return new $className(...$depedencies);
    }
}
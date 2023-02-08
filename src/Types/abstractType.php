<?php

namespace Mateodioev\TelegrahApi\Types;

abstract class abstractType
{
    public const DEFAULT_PARAM = null;

    /**
     * @return static Get new instance
     */
    public static function get(): static
    {
        return new static();
    }

    /**
     * Get property
     * @throws TypeException
     */
    private function getProperty(string $property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        throw new TypeException("Property {$property} not exists");
    }

    /**
     * @throws TypeException
     */
    public function __call(string $name, array $arguments)
    {
        $name = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));

        if (str_starts_with($name, 'get')) {
            return $this->getProperty($name);
        }
    }
}
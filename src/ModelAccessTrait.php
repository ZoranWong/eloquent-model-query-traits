<?php


namespace ZoranWong\EloquentModelQueryTrait;


trait ModelAccessTrait
{
    public function __get($name)
    {
        if (!isCamelize($name)) {
            throw new ModelAccessException("{$name} is not named by camel-case, it not allow.", 500);
        }
        $key = unCamelize($name);
        return $this->getAttributeValue($key) ?? $this[$key];
    }

    public function __set($name, $value)
    {
        if (!isCamelize($name)) {
            throw new ModelAccessException("{$name} is not named by camel-case, it not allow.", 500);
        }
        // TODO: Implement __set() method.
        $this->setAttribute(unCamelize($name), $value);
    }

    public function __isset($name)
    {
        if (!isCamelize($name)) {
            throw new ModelAccessException("{$name} is not named by camel-case, it not allow.", 500);
        }
        // TODO: Implement __isset() method.
        return !!$this->{$name};
    }

    public function __unset($name)
    {
        if (!isCamelize($name)) {
            throw new ModelAccessException("{$name} is not named by camel-case, it not allow.", 500);
        }
        // TODO: Implement __unset() method.
        $name = unCamelize($name);
        unset($this->attributes[$name], $this->relations[$name]);
    }
}

<?php

namespace App\Pattern;

trait PropertyConteiner
{
    /**
     * @var array
     */
    private $properties = [];

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->getProperty($name);
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->setProperty($name, $value);
    }

    /**
     * @param $name
     */
    public function __unset($name)
    {
        $this->deleteProperty($name);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getProperty($name)
    {
        return $this->properties[$name] ?? null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function setProperty($name, $value) :void
    {
        $this->properties[$name] = $value;
    }

    /**
     * @param $name
     *
     * @return void
     */
    public function deleteProperty($name)
    {
        unset($this->properties[$name]);
    }

}
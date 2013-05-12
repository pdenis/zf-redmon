<?php

namespace Snide\Redmon\Model;

/**
 * Class Info
 * 
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class Info implements \ArrayAccess
{
	protected $container;

	public function __construct(array $datas)
	{
		$this->container = $datas;
	}

	public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : '?';
    }
}
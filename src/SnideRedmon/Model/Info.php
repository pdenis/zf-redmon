<?php

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace SnideRedmon\Model;

/**
 * Class Info
 * 
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class Info implements \ArrayAccess, \Iterator
{
	protected $container;
    protected $index;

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

    public function rewind()
    {
        $this->index = 0;
    }
    public function current()
    {
        $k = array_keys($this->container);

        return $this->container[$k[$this->index]] ? $this->container[$k[$this->index]] : '?';
    }

    public function key()
    {
        $k = array_keys($this->container);

        return $k[$this->index];
    }

    public function next()
    {
        $k = array_keys($this->container);
        if (isset($k[++$this->index])) {
            $var = $this->container[$k[$this->index]];
            return $var;
        } else {
            return false;
        }
    }

    public function valid()
    {
        $k = array_keys($this->container);
        
        return isset($k[$this->index]);
    }
}
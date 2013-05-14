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

namespace SnideRedmon\Manager;

use SnideRedmon\Model\Instance;

use SnideRedmon\Mapper\InstanceMapperInterface;

/**
 * Class InstanceManager
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class InstanceManager
{
    /**
     * Entity manager
     * 
     * @var mixed
     */
    protected $mapper;
    
    /**
     * Instance class
     * 
     * @var string
     */
    protected $class;
    
    /**
     * Constructor
     * 
     * @param \SnideRedmon\Mapper\InstanceMapperInterface $instanceMapper
     * @param string $class
     */
    public function __construct(InstanceMapperInterface$instanceMapper, $class)
    {
        $this->mapper = $instanceMapper;
        $this->class = $class;
    }
    
    /**
     * Create a new instance
     * 
     * @param \SnideRedmon\Model\Instance $instance
     */
    public function create(Instance $instance)
    {
        $this->mapper->create($instance);
    }
    
    /**
     * Update an existing instance
     * 
     * @param \SnideRedmon\Model\Instance $instance
     */
    public function update(Instance $instance)
    {
        $this->mapper->update($instance);
    }
    
    /**
     * Remove an existing instance
     * 
     * @param \SnideRedmon\Model\Instance $instance
     */
    public function delete(Instance $instance)
    {
        $this->mapper->remove($instance);
    }
    
    /**
     * Find an instance by ID
     * 
     * @param string $id
     * @return \SnideRedmon\Model\Instance 
     */
    public function find($id)
    {
        return $this->mapper->find($id);
    }
    
    /**
     * Find all instances
     * 
     * @return array
     */
    public function findAll()
    {
        return $this->mapper->findAll();
    }
    
    /**
     * Create an empty Redis instance
     * 
     * @return \SnideRedmon\Model\Instance
     */
    public function createNew()
    {
        $class = $this->class;
        
        return new $class;
    }
}
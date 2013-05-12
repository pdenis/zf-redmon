<?php

namespace Snide\Redmon\Manager;

use Snide\Redmon\Model\Instance;

use Snide\Redmon\Mapper\InstanceMapperInterface;

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
     * @param \Snide\Redmon\Mapper\InstanceMapperInterface $instanceMapper
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
     * @param \Snide\Redmon\Model\Instance $instance
     */
    public function create(Instance $instance)
    {
        $this->mapper->create($instance);
    }
    
    /**
     * Update an existing instance
     * 
     * @param \Snide\Redmon\Model\Instance $instance
     */
    public function update(Instance $instance)
    {
        $this->mapper->update($instance);
    }
    
    /**
     * Remove an existing instance
     * 
     * @param \Snide\Redmon\Model\Instance $instance
     */
    public function delete(Instance $instance)
    {
        $this->mapper->remove($instance);
    }
    
    /**
     * Find an instance by ID
     * 
     * @param string $id
     * @return \Snide\Redmon\Model\Instance 
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
     * @return \Snide\Redmon\Model\Instance
     */
    public function createNew()
    {
        $class = $this->class;
        
        return new $class;
    }
}
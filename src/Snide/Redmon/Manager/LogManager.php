<?php

namespace Snide\Redmon\Manager;

use Snide\Redmon\Model\Log;
use Snide\Redmon\Mapper\LogMapperInterface;

/**
 * Class LogManager
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class LogManager
{
    /**
     * Mapper
     * 
     * @var mixed
     */
    protected $mapper;
    
    /**
     * Log class
     * 
     * @var string
     */
    protected $class;
    
    /**
     * Constructor
     * 
     * @param \Snide\Redmon\Mapper\LogMapperInterface $LogMapper
     * @param string $class
     */
    public function __construct(LogMapperInterface $logMapper, $class)
    {
        $this->mapper = $logMapper;
        $this->class = $class;
    }
    
    /**
     * Create a new Log
     * 
     * @param \Snide\Redmon\Model\Log $Log
     */
    public function create(Log $Log)
    {
        $this->mapper->create($Log);
    }
    
    /**
     * Update an existing Log
     * 
     * @param \Snide\Redmon\Model\Log $Log
     */
    public function update(Log $Log)
    {
        $this->mapper->update($Log);
    }
    
    /**
     * Remove an existing Log
     * 
     * @param \Snide\Redmon\Model\Log $Log
     */
    public function delete(Log $Log)
    {
        $this->mapper->remove($Log);
    }
    
    /**
     * Find Log by ID
     * 
     * @param string $id
     * @return \Snide\Redmon\Model\Log 
     */
    public function find($id)
    {
        return $this->mapper->find($id);
    }
    
    /**
     * Find all Logs
     * 
     * @return array
     */
    public function findAll()
    {
        return $this->mapper->findAll();
    }
    
    /**
     * Create an empty Redis Log
     * 
     * @return \Snide\Redmon\Model\Log
     */
    public function createNew()
    {
        $class = $this->class;
        
        return new $class;
    }
}
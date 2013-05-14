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

use SnideRedmon\Model\Log;
use SnideRedmon\Mapper\LogMapperInterface;

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
     * @param \SnideRedmon\Mapper\LogMapperInterface $LogMapper
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
     * @param \SnideRedmon\Model\Log $Log
     */
    public function create(Log $Log)
    {
        $this->mapper->create($Log);
    }
    
    /**
     * Update an existing Log
     * 
     * @param \SnideRedmon\Model\Log $Log
     */
    public function update(Log $Log)
    {
        $this->mapper->update($Log);
    }
    
    /**
     * Remove an existing Log
     * 
     * @param \SnideRedmon\Model\Log $Log
     */
    public function delete(Log $Log)
    {
        $this->mapper->remove($Log);
    }
    
    /**
     * Find Log by ID
     * 
     * @param string $id
     * @return \SnideRedmon\Model\Log 
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
     * @return \SnideRedmon\Model\Log
     */
    public function createNew()
    {
        $class = $this->class;
        
        return new $class;
    }
}
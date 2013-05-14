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

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Instance
 *
 * Represents a Redis instance
 * 
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class Instance 
{
    /**
     * ID
     * 
     * @var string
     */
    protected $id;
    
    /**
     * Name
     * 
     * @var string 
     */
    protected $name;
    
    /**
     * Port
     * 
     * @var string 
     */
    protected $port;
    
    /**
     * Host
     * 
     * @var string 
     */
    protected $host;
    
    /**
     * Databases
     * 
     * @var \Doctrine\Common\Collections\ArrayCollection  
     */
    protected $databases;
    
    /**
     * Logs
     * 
     * @var \Doctrine\Common\Collections\ArrayCollection  
     */
    protected $logs;
    
    /**
     * State 
     * 
     * @var boolean 
     */
    protected $working;
    
    /**
     * Potential error message
     * 
     * @var string 
     */
    protected $error;
    
    /**
     * Add a log
     * 
     * @param \SnideRedmon\Model\Log $log
     */
    public function addLog(Log $log)
    {
        $log->setInstance($this);
        $this->getLogs()->add($log);
    }
    
    /**
     * Remove a log
     * 
     * @param \SnideRedmon\Model\Log $log
     */
    public function removeLog(Log $log)
    {
        $this->getLogs()->remove($log);
    }
    
    /**
     * Get ID
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Get host
     * 
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }
    
    /**
     * Get port
     * 
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }
    
    /**
     * Get potential error message
     * 
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }
    
    /**
     * Get logs
     * 
     * @return \Doctrine\Common\Collections\ArrayCollection  
     */
    public function getLogs()
    {
        if($this->logs == null) {
            $this->logs = new ArrayCollection();
        }
        
        return $this->logs;
    }
    
    /**
     * Get state
     * 
     * @return boolean
     */
    public function isWorking()
    {
        return $this->working;
    }
    
    /**
     * Set ID
     * 
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Set name
     * 
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Set host
     * 
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }
    
    /**
     * Set port
     * 
     * @param string $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }
 
    /**
     * Set error message
     * 
     * @param string $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }
    
    /**
     * Set logs
     * 
     * @param \Doctrine\Common\Collections\ArrayCollection $logs
     */
    public function setLogs(ArrayCollection $logs)
    {
        $this->logs = $logs;
    }
    
    /**
     * Set state
     * 
     * @param boolean $working
     */
    public function setWorking($working) 
    {
        $this->working = $working;
    }
}
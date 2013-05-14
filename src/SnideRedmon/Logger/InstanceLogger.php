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

namespace SnideRedmon\Logger;

use SnideRedmon\Model\Instance;
use SnideRedmon\Manager\InstanceManager;
use SnideRedmon\Manager\LogManager;
use SnideRedmon\Worker\InstanceWorker;
use SnideRedmon\Model\Log;

/**
 * Class InstanceLogger
 *
 * This class manage instance's logs 
 * 
 * @author Patrick Deroubaix <patrick.deroubaix@gmail.com>
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class InstanceLogger 
{
    /**
     * Current instance
     * 
     * @var \Ringo\Bundle\PhpRedmonBundle\Model\Instance
     */
    protected $instance;
    
    /**
     * Expired timestamp
     * 
     * @var int
     */
    protected $expiredTimestamp;
    
    /**
     * Current instance manager
     * 
     * @var \SnideRedmon\Manager\InstanceManager
     */
    protected $instanceManager;
    
    /**
     * Current instance manager
     * 
     * @var \SnideRedmon\Manager\LogManager
     */
    protected $logManager;

    /**
     * Constructor
     * 
     * @param \SnideRedmon\Manager\InstanceManager $manager
     * @param \SnideRedmon\Manager\LogManager $manager
     * @param \SnideRedmon\Worker\InstanceWorker $worker
     * @param int $nbDays
     */
    public function __construct(InstanceManager $instanceManager, LogManager $logManager, InstanceWorker $worker, $nbDays) 
    {
        $this->instanceManager = $instanceManager;
        $this->logManager = $logManager;
        $this->worker  = $worker;
        $this->expiredTimestamp  = $nbDays * 24 * 60 * 60;
    }
    
    /**
     * Get current instance
     * 
     * @return \Ringo\Bundle\PhpRedmonBundle\Model\Instance
     */
    public function getInstance()
    {
        return $this->instance;
    }
    
    /**
     * Set current instance
     * 
     * @param \Ringo\Bundle\PhpRedmonBundle\Model\Instance $instance
     * @return \Ringo\Bundle\PhpRedmonBundle\Logger\InstanceLogger
     */
    public function setInstance(Instance $instance)
    {
        $this->instance = $instance;
        
        return $this;
    }
    
    /**
     * Get instance manager
     * 
     * @return \SnideRedmon\Manager\InstanceManager
     */
    public function getInstanceManager()
    {
        return $this->manager;
    }
    
    /**
     * Set instance manager
     * 
     * @param \SnideRedmon\Manager\InstanceManager $manager
     * @return \SnideRedmon\Logger\InstanceLogger
     */
    public function setInstanceManager(InstanceManager $manager)
    {
        $this->instanceManager = $manager;
        
        return $this;
    }

    /**
     * Get instance manager
     * 
     * @return \SnideRedmon\Manager\LogManager
     */
    public function getLogManager()
    {
        return $this->manager;
    }
    
    /**
     * Set instance manager
     * 
     * @param \SnideRedmon\Manager\LogManager $manager
     * @return \SnideRedmon\Logger\InstanceLogger
     */
    public function setLogManager(LogManager $manager)
    {
        $this->logManager = $manager;
        
        return $this;
    }
    
    /**
     * Get instance worker
     * 
     * @return \Ringo\Bundle\PhpRedmonBundle\Worker\InstanceWorker
     */
    public function getWorker()
    {
        return $this->worker;
    }
    
    /**
     * Set instance worker
     * 
     * @param \Ringo\Bundle\PhpRedmonBundle\Worker\InstanceWorker $worker
     * @return \Ringo\Bundle\PhpRedmonBundle\Logger\InstanceLogger
     */
    public function setWorker(InstanceWorker $worker)
    {
        $this->worker = $worker;
        
        return $this;
    }
    
    /**
     * Execute all steps for current instance
     * - Clean history
     * - Add log
     * - Save current instance state
     */
    public function execute()
    {
        $this->cleanHistory();
        $this->log();
        $this->instanceManager->update($this->instance);
    }
    
    /**
     * Clean instance history. Delete expired logs
     */
    protected function cleanHistory()
    {
        $createdAt = new \DateTime();
        $logs = $this->instance->getLogs();
        foreach($logs as $log) {
            if(($createdAt->getTimestamp() - $log->getCreatedAt()->getTimestamp()) > $this->expiredTimestamp) {
                $this->instance->removeLog($log);
            }
        }
    }
    
    /**
     * Create new log for the current instance
     */
    protected function log()
    {

        $this->worker
            ->setInstance($this->instance);
        // If instance can be called
        if($this->worker->ping()) {
            $infos = $this->worker->getInfos();
            $createdAt = new \DateTime();

            $log = $this->logManager->createNew();
            $log->setMemory($infos['Memory']['used_memory']);
            $log->setCpu($infos['CPU']['used_cpu_sys']);
            $log->setNbClients(sizeof($this->worker->getClients()));
            $log->setCreatedAt($createdAt);
            // Add log
            $this->instance->addLog($log);
        }
    }
}
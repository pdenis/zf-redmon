<?php

namespace Snide\Redmon\Entity;

use Snide\Redmon\Model\Log as ModelLog;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Log
 *
 * Represents a simple log for Redis instance
 * 
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * @ORM\Entity(repositoryClass="Snide\Redmon\Repository\LogRepository")
 * @ORM\Table(name="Logs")
 */
class Log extends ModelLog
{
    /**
     * ID
     * 
     * @var string 
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * Created date
     * 
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    
    /**
     * Memory usage
     * 
     * @var string 
     *
     * @ORM\Column(type="integer", length=25)
     */
    protected $memory;

    /**
     * CPU usage
     * 
     * @var string
     * 
     * @ORM\Column(type="decimal")
     */
    protected $cpu;

    /**
     * nbClients connected
     * 
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $nbClients;


    /**
     * Instance
     * 
     * @var Instance
     *
     * @ORM\ManyToOne(targetEntity="Snide\Redmon\Entity\Instance", inversedBy="logs")
     * @ORM\JoinColumn(onDelete="cascade")
     */
    protected $instance;

}
<?php

namespace Snide\Redmon\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Snide\Redmon\Model\Instance as ModelInstance;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Instance
 *
 * Represents a Redis instance
 * 
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * @ORM\Entity(repositoryClass="Snide\Redmon\Repository\InstanceRepository")
 * @ORM\Table(name="Instances")
 * })
 */
class Instance extends ModelInstance
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
     * Name
     * 
     * @var string 
     *
     * @ORM\Column(type="string", length=128)
     */
    protected $name;
    
    /**
     * Port
     * 
     * @var string 
     *
     * @ORM\Column(type="string", length=5)
     */
    protected $port;
    
    /**
     * Host
     * 
     * @var string 
     *
     * @ORM\Column(type="string", length=128)
     */
    protected $host;

    /**
     * Logs
     * 
     * @var \Doctrine\Common\Collections\ArrayCollection  
     *
     *
     * @ORM\OneToMany(targetEntity="Snide\Redmon\Entity\Log", mappedBy="instance", cascade={"persist"}, fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"createdAt"="ASC"})
     */
    protected $logs;
}
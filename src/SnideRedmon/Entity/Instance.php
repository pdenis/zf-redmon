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

namespace SnideRedmon\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use SnideRedmon\Model\Instance as ModelInstance;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Instance
 *
 * Represents a Redis instance
 * 
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * @ORM\Entity(repositoryClass="SnideRedmon\Repository\InstanceRepository")
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
     * @ORM\OneToMany(targetEntity="SnideRedmon\Entity\Log", mappedBy="instance", cascade={"persist"}, fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"createdAt"="ASC"})
     */
    protected $logs;
}
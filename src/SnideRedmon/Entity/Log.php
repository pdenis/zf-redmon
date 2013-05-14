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

use SnideRedmon\Model\Log as ModelLog;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Log
 *
 * Represents a simple log for Redis instance
 * 
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * @ORM\Entity(repositoryClass="SnideRedmon\Repository\LogRepository")
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
     * @ORM\ManyToOne(targetEntity="SnideRedmon\Entity\Instance", inversedBy="logs")
     * @ORM\JoinColumn(onDelete="cascade")
     */
    protected $instance;

}
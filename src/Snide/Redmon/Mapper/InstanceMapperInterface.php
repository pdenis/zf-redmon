<?php

namespace Snide\Redmon\Mapper;

use Snide\Redmon\Model\Instance;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Class InstanceMapperInterface
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
interface InstanceMapperInterface extends ObjectRepository
{
	public function create(Instance $instance);
	public function update(Instance $instance);
	public function remove(Instance $instance);
}
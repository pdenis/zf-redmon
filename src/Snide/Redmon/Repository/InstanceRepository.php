<?php

namespace Snide\Redmon\Repository;

use Snide\Redmon\Mapper\InstanceMapperInterface;
use Snide\Redmon\Model\Instance;
use Doctrine\ORM\EntityRepository;
/**
 * Class InstanceRepository
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class InstanceRepository extends EntityRepository implements InstanceMapperInterface
{
	public function create(Instance $instance)
	{
		$this->_em->persist($instance);
		$this->_em->flush();

		return $instance;
	}

	public function update(Instance $instance)
	{
		$this->_em->flush($instance);
		
		return $instance;
	}

	public function remove(Instance $instance)
	{
		$this->_em->remove($instance);
		$this->_em->flush();
	}
}
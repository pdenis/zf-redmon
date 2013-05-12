<?php

namespace Snide\Redmon\Repository;

use Snide\Redmon\Mapper\LogMapperInterface;
use Snide\Redmon\Model\Log;
use Doctrine\ORM\EntityRepository;

/**
 * Class LogRepository
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class LogRepository extends EntityRepository implements LogMapperInterface
{
	public function create(Log $Log)
	{
		$this->_em->persist($Log);
		$this->_em->flush();

		return $Log;
	}

	public function update(Log $Log)
	{
		$this->_em->flush($Log);
		
		return $Log;
	}

	public function remove(Log $Log)
	{
		$this->_em->remove($Log);
		$this->_em->flush();
	}
}
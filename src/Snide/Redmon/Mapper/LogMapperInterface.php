<?php

namespace Snide\Redmon\Mapper;

use Snide\Redmon\Model\Log;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Class LogMapperInterface
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
interface LogMapperInterface extends ObjectRepository
{
	public function create(Log $log);
	public function update(Log $log);
	public function remove(Log $log);
}
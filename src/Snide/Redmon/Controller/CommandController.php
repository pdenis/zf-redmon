<?php

namespace Snide\Redmon\Controller;

use Zend\Console\Request as ConsoleRequest;

/**
 * Class Controller
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class CommandController extends Controller
{
	public function executeAction()
    {
        $request = $this->getRequest();
        try {
            if (!$request instanceof ConsoleRequest){
                throw new \RuntimeException('You can only use this action from a console!');
            }

            $logger = $this->getLogger();
            $instances = $this->getManager()->findAll();
            
            if(is_array($instances)) {
                foreach($instances as $instance) {
                    $logger
                        ->setInstance($instance)
                        ->execute();
                }
            }

            printf('snide-redmon log : OK');
        }catch(\Exception $e) {
            printf('snide-redmon log : '.$e->getMessage());
        }
    }

    protected function getLogger()
    {
        return $this->getServiceLocator()->get('snide_redmon.logger.instance');
    }
}
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

namespace SnideRedmon\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

/**
 * Class Controller
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class Controller extends AbstractActionController
{
	protected function createView($path= '', $params = array())
	{
        $this->initLayout();

        $view = new ViewModel($params);
        if($path) {
            $config = $this->getServiceLocator()->get('Config');
            $view->setTemplate($config['view_manager']['template_path'].$path);
        }
        return $view;
	}

    
    protected function initLayout()
    {
        $this->layout('layout');
        

        $this->layout()->setVariables(array(
            'instance'  => $this->getCurrentInstance(),
            'instances' => $this->getManager()->findAll(),
            'route'     => $this->getRouteName()
        ));
    }

    protected function getRouteName()
    {
        $router = $this->getServiceLocator()->get('router');
        $request = $this->getRequest();

        $routeMatch = $router->match($request);

        return $routeMatch->getMatchedRouteName();
    }
	/**
     * Get instance manager
     * 
     * @return mixed
     */
    protected function getManager()
    {
        return $this->getServiceLocator()->get('snide_redmon.manager.instance');
    }
    
    /**
     * Get the current instance if exists
     * 
     * @return mixed
     */
    protected function getCurrentInstance()
    {
        $instance = $this->getSession()->instance;
        
        if($instance) {
            // Update of instance to have last logs created
            $instance = $this->getManager()->find($instance->getId());
        }
        return $instance;
    }
    
    /**
     * Get the current session 
     * 
     * @return \Zend\Session\Container
     */
    protected function getSession()
    {
        return new Container('snide_redmon');
    }
    /**
     * Get instance worker initialized with current instance
     * 
     * @return boolean
     */
    protected function getWorker()
    {
        $instance = $this->getCurrentInstance();
        if($instance) {
            // Initialized with the current instance
            
            $worker = $this->getServiceLocator()
                ->get('snide_redmon.worker.instance')
                ->setInstance($instance);
            // We return worker only if the server is up
            if($worker->ping()) {
                return $worker;
            }
            // If we can't ping the server, current instance is removed from session
            $this->getSession()->instance = null;
            
            return false;
        }
        return false;
    }

    protected function setFlashMessage($ns, $message)
    {
        $this->flashMessenger()
            ->setNamespace($ns)
            ->addMessage($message);
    }
}
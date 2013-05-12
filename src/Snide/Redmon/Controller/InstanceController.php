<?php

namespace Snide\Redmon\Controller;

/**
 * Class InstanceController
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class InstanceController extends Controller
{
	public function indexAction()
	{
		// Get all instances
        $instances = $this->getManager()->findAll();
        
        $worker = $this->getServiceLocator()->get('snide_redmon.worker.instance');
        if(is_array($instances)) {
            foreach($instances as $index => $instance) {
                // Ping server and get potential error message
                $working = $worker->setInstance($instance)->ping();
                $instances[$index]->setWorking($working);
                $instances[$index]->setError($worker->getMessage());
            }
        }
		return $this->createView('instance/index', array(
			'instances' => $instances
		));
	}

	public function createAction()
	{
		$form = $this->getForm();
		$request = $this->getRequest();

		if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getManager()->create($form->getObject());
                $this->setFlahsMessage('success', 'Instance created successfully');

                return $this->redirect()->toRoute('snide_redmon_instance');
            }else {
                $this->setFlahsMessage('error', 'Something went wrong');
            }
		}
		
		return $this->createView('instance/new', array(
			'form' => $form
		));
	}

	public function updateAction()
	{

		$request = $this->getRequest();
		$instance = $this->getManager()->find($this->params('id'));
		$form = $this->getForm();
		if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
               
                $this->getManager()->update($form->getObject());
                $this->setFlahsMessage('success', 'Instance updated successfully');
                
                return $this->redirect()->toRoute('snide_redmon_instance');
            }else {
                $this->setFlahsMessage('error', 'Something went wrong');
            }
		}
		
		return $this->createView('instance/edit', array(
			'form' => $form
		));
	}

	public function deleteAction()
	{
		$instance = $this->getManager()->find($this->params('id'));
		if($instance) {
			try {
				$this->getManager()->remove($instance);
				$this->setFlahsMessage('success', 'Instance removed successfully');
			}catch(\Exception $e) {
				$this->setFlashMessage('error', 'An error has occured : '.$e->getMessage());
			}
		}

		return $this->createView('instances', array(
			'form' => $form
		));
	}

	/**
     * Select action
     * Change the current instance
     * 
     * @param string $id
     */
    public function selectAction()
    {
        $instance = $this->getManager()->find($this->params('id'));
        // If instance exists
        if($instance) {
            $this->getSession()->instance = $instance;
            if($this->getWorker()) {
                $this->setFlashMessage('success', 'Instance '.$instance->getName().' selected');
            }else {
                $this->setFlashMessage('error', 'Instance '.$instance->getName().' cannot be selected');
            }
        }else {
            $this->setFlashMessage('error', 'This instance does not exist');
        }
        
        return $this->redirect()->toRoute('snide_redmon');
    }

	protected function getForm(Instance $instance = null)
	{
		$form = $this->getServiceLocator()->get('snide_redmon.form.instance');
		if(!$instance) {
			$instance = $this->getServiceLocator()->get('snide_redmon.entity.instance');
		}
		$form->bind($instance);

		return $form;
	}
}
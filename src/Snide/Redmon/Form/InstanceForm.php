<?php

namespace Snide\Redmon\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Class InstanceForm
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class InstanceForm extends Form
{
	public function __construct($name = null)
    {
        parent::__construct($name);
        $this->setHydrator(new ClassMethods());
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name',
            ),
        ));

        $this->add(array(
            'name' => 'host',
            'type' => 'Text',
            'options' => array(
                'label' => 'Host',
            ),
        ));

        $this->add(array(
            'name' => 'port',
            'type' => 'Text',
            'options' => array(
                'label' => 'Port',
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submitbutton',
            ),
        ));
    }
}
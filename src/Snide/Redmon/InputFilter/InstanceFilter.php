<?php

namespace Snide\Redmon\InputFilter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

/**
 * Class InstanceFilter
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class InstanceFilter extends InputFilter
{
	public function __construct()
	{
		$this->add(
			array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )
        );

		$this->add(
			array(
                'name'     => 'port',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                          'name' => 'Between',
                          'options' => array(
                              'min' => 1,
                              'max' => 65536,
                          ),
                    ),
                ),
            )
        );

        $this->add(
			array(
                'name'     => 'host',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 128,
                        ),
                    ),
                ),
            )
		);

		$this->add(
			array(
                'name'     => 'name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 128,
                        ),
                    ),
                ),
            )
		);

	}
}
<?php
/**
 * This file is part of the TarSignup Module (https://github.com/xFran/TarSignup.git)
 *
 * @link      https://github.com/xFran/TarSignup.git for the canonical source repository
 * @copyright Copyright (c) 2013 Francisc Tar (https://github.com/xFran/TarSignup.git)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace TarSignup\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Crypt\Password\Bcrypt;

class Signup implements InputFilterAwareInterface
{
    public $name;
    public $username;
    public $password;
    public $salt;
    public $email;
    public $hash;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $bcrypt = new Bcrypt(array(
            			'salt' => 'XMG_-2)*|vU@L)vWJceU96,Og[`)9BNW]F.`66fYrls\'uX^=1V',
            			'cost' => 10,
                	));
        for ($i = 0; $i < 50; $i++) {
        	$data['salt'] .= chr(rand(33, 126));
        }
        $data['password'] = md5($data['salt'] . $bcrypt->create($data['password']));
    	$this->name     = (isset($data['name']))       ? ucfirst($data['name']) : NULL;
    	$this->username = (isset($data['username']))   ? $data['username']      : NULL;
    	$this->password = (isset($data['password']))   ? $data['password']      : NULL;
    	$this->salt     = (isset($data['salt']))       ? $data['salt']          : NULL;
    	$this->email    = (isset($data['email']))      ? $data['email']         : NULL;
    	$this->hash     = (isset($data['security']))   ? $data['security']      : NULL;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
    	throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
    	if (!$this->inputFilter) {
    		$inputFilter = new InputFilter();
    		$factory     = new InputFactory();
    		$inputFilter->add($factory->createInput(array(
				'name' => 'name',
				'requiered' => TRUE,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 3,
							'max'      => 30,
						),
					),
				    /*** XAMPP ERROR Zend\I18n\Filter component requires the intl PHP extension ***/
				    /*
					 array(
    				   'name'    => 'Alpha',
	    				'options' => array(
	    						'allowWhiteSpace' => FALSE,
	    				),
			        ),
			        */
				),
    		)));
    		$inputFilter->add($factory->createInput(array(
				'name' => 'username',
				'required' => TRUE,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 3,
							'max'      => 30,
						),
					),
				),
    		)));
    		$inputFilter->add($factory->createInput(array(
				'name' => 'password',
				'required' => TRUE,
				'filters' => array(
						array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 3,
							'max'      => 50,
						),
					),
				),
    		)));
    		$inputFilter->add($factory->createInput(array(
				'name' => 'repassword',
				'required' => TRUE,
				'filters' => array(
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 3,
							'max'      => 50,
						),
					),
					array(
						'name' => 'identical',
						'options' => array(
							'token' => 'password',
							'messages' => array(\Zend\Validator\Identical::NOT_SAME => 'Please retype the same password.'),
						),
					),
				),
    		)));
    		$inputFilter->add($factory->createInput(array(
				'name' => 'email',
				'required' => TRUE,
				'filters' => array(
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 3,
							'max'      => 100,
						),
					),
					array(
						'name' => 'EmailAddress',
						'options' => array(
							'useMxCheck' => FALSE
						),
					),
				),
    		)));
    		$inputFilter->add($factory->createInput(array(
				'name' => 'reemail',
				'required' => TRUE,
				'filters' => array(
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 3,
							'max'      => 100,
						),
					),
					array(
						'name' => 'EmailAddress',
						'options' => array(
							'useMxCheck' => FALSE
						),
					),
					array(
						'name' => 'identical',
						'options' => array(
							'token' => 'email',
						),
					),
					array(
						'name' => 'identical',
						'options' => array(
    	    				'token' => 'email',
    	    				'messages' => array(\Zend\Validator\Identical::NOT_SAME => 'Please retype the same email address.'),
						),
					),
				),
    		)));
    		$this->inputFilter = $inputFilter;
    	}
    	return $this->inputFilter;
    }
}
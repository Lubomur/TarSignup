<?php
/**
 * This file is part of the TarSignup Module (https://github.com/xFran/TarSignup.git)
 *
 * @link      https://github.com/xFran/TarSignup.git for the canonical source repository
 * @copyright Copyright (c) 2013 Francisc Tar (https://github.com/xFran/TarSignup.git)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
 
namespace TarSignup\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class LoginForm extends Form
{
    public function __construct ($name = NULL)
    {
        parent::__construct('LoginForm');
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');
        
        $this->add(new Element\Csrf('security'));
        $this->add(array(
    		'name' => 'username',
    		'attributes' => array(
				'type' => 'text',
				'placeholder' => 'Your username',
    		),
    		'options' => array(
				'label' => 'Username:',
    		),
        ));
        $this->add(array(
    		'name' => 'password',
    		'attributes' => array(
				'type' => 'password',
				'placeholder' => 'Your password',
    		),
    		'options' => array(
				'label' => 'Password:',
    		),
        ));
        $this->add(array(
    		'type' => 'checkbox',
    		'name' => 'remember',
    		'options' => array(
				'label' => 'Remember Me?:',
				'checked_value' => 1,
    		)
        ));
        $this->add(array(
    		'name' => 'signin',
    		'attributes' => array(
				'type' => 'submit',
				'value' => 'Sign in',
				'class' => 'btn btn-success',
    		),
    		'options' => array(
				'label' => 'Sign in'
    		),
        ));
    }
}
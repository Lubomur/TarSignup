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

class RegisterForm extends Form
{
    public function __construct ($name = NULL)
    {

        parent::__construct('RegisterForm');

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(new Element\Csrf('security'));
        $this->add(array(
    		'name' => 'name',
    		'attributes' => array(
				'type' => 'text',
				'placeholder' => 'Your real name',
    		),
    		'options' => array(
				'label' => 'Name:',
    		),
        ));
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
    		'name' => 'repassword',
    		'attributes' => array(
				'type' => 'password',
				'placeholder' => 'Repeat your password',
    		),
    		'options' => array(
				'label' => 'Repeat Password:',
    		),
        ));
        $this->add(array(
    		'name' => 'email',
    		'attributes' => array(
				'type' => 'email',
				'placeholder' => 'Your email',
    		),
    		'options' => array(
				'label' => 'Email:',
    		),
        ));
        $this->add(array(
    		'name' => 'reemail',
    		'attributes' => array(
				'type' => 'email',
				'placeholder' => 'Repeat your email',
    		),
    		'options' => array(
				'label' => 'Repeat Email:'
    		),
        ));
        $this->add(array(
    		'name' => 'save',
    		'attributes' => array(
				'type' => 'submit',
				'value' => 'Submit',
				'class' => 'btn btn-success',
    		),
    		'options' => array(
				'label' => 'Save'
    		),
        ));
        $this->add(array(
    		'name' => 'cancel',
    		'attributes' => array(
				'type' => 'cancel',
				'value' => 'Cancel',
				'class' => 'btn btn-primary',
    		),
    		'options' => array(
				'label' => 'Cancel'
    		),
        ));
    }
}

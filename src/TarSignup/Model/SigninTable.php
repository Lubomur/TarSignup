<?php
/**
 * This file is part of the TarSignup Module (https://github.com/xFran/TarSignup.git)
 *
 * @link      https://github.com/xFran/TarSignup.git for the canonical source repository
 * @copyright Copyright (c) 2013 Francisc Tar (https://github.com/xFran/TarSignup.git)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace TarSignup\Model;

use Zend\Db\TableGateway\TableGateway;

class SigninTable
{
    protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
	    $this->tableGateway = $tableGateway;
	}

	public function getUserData($username, $password = NULL)
	{
	    if (empty($password)) {
	        $rowset = $this->tableGateway->select(array(
        		'username' => $username,
	        ));
	    } else {
	        $rowset = $this->tableGateway->select(array(
        		'username' => $username,
	            'password' => $password,
	        ));
	    }
	    $row = $rowset->current();
	    return ($row) ? $row : FALSE;
	}

	public function setStateActive($username)
	{
	    $data = array(
    		'state' => 1,
	    );
	    $this->tableGateway->update($data, array('username' => $username));
	}

	public function setStateInactive($username)
	{
		$data = array(
			'state' => 0,
		);
		$this->tableGateway->update($data, array('username' => $username));
	}
}
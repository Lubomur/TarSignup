<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/TarSignup for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace TarSignup;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use TarSignup\Model\Signup;
use TarSignup\Model\Signin;
use TarSignup\Model\SignupTable;
use TarSignup\Model\SigninTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthDbTable;
use Zend\Crypt\Password\Bcrypt;
use Zend\Session\SaveHandler\DbTableGateway;
use Zend\Session\SaveHandler\DbTableGatewayOptions;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session;
use Zend\Session\Container;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'TarSignup\Model\SignupTable' => function($sm) {
                    $tableGateway = $sm->get('SignupTableGateway');
                    $row          = new SignupTable($tableGateway);
                    return $row;
                },
                'SignupTableGateway' => function ($sm) {
                    $dbAdapter          = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Signup());
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
                'TarSignup\Model\SigninTable' => function($sm) {
                	$tableGateway = $sm->get('SigninTableGateway');
                	$row          = new SigninTable($tableGateway);
                	return $row;
                },
                'SigninTableGateway' => function ($sm) {
                	$dbAdapter          = $sm->get('Zend\Db\Adapter\Adapter');
                	$resultSetPrototype = new ResultSet();
                	$resultSetPrototype->setArrayObjectPrototype(new Signin());
                	return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
                'AuthDbTable' => function($sm) {
                	$dbAdapter      = $sm->get('Zend\Db\Adapter\Adapter');
                	$authDbTable    = new AuthDbTable($dbAdapter);
                	return $authDbTable;
                },
                'SessionStorage' => function($sm) {
                    $sessionStorage = new Session();
                    return $sessionStorage;
                },
                'AuthService' => function($sm) {
                    $authService    = new AuthenticationService();
                    return $authService;
                },
                'SessionManager' => function($sm) {
                	$sessionManager   = new SessionManager();
                	return $sessionManager;
                },
                'Bcrypt' => function($sm) {
                	$bcrypt = new Bcrypt(array(
            			'salt' => 'XMG_-2)*|vU@L)vWJceU96,Og[`)9BNW]F.`66fYrls\'uX^=1V',
            			'cost' => 10,
                	));
                	return $bcrypt;
                },
                'SessionSaveManager' => function($sm) {
                    $dbAdapter           = $sm->get('Zend\Db\Adapter\Adapter'); /*** $sm->get('Zend\Db\Adapter\Session')); ??? WTF??? ***/
                    $sessionTableGateway = new TableGateway('session', $dbAdapter);
                    $optionsTableGateway = new DbTableGatewayOptions();
                    $optionsTableGateway -> setIdColumn('id')
                                         ->setNameColumn('name')
                                         ->setModifiedColumn('modified')
                                         ->setLifetimeColumn('lifetime')
                                         ->setDataColumn('data');
                    $sessionSaveHandler  = new DbTableGateway($sessionTableGateway, $optionsTableGateway);
                    $sessionManager = new SessionManager();
					$sessionManager->setSaveHandler($sessionSaveHandler);
					Container::setDefaultManager($sessionManager);
                    return $sessionManager;
                },
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap($e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $sm = $e->getApplication()->getServiceManager();
        $sessionManager = $sm->get('SessionSaveManager');
        $sessionManager->start();
    }
}
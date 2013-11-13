<?php
/**
 * Description of indexController
 * This controller works as a front controller
 *
 * @author Faisal Ahmed
 */
session_start();
require_once 'controller.php';

$myPage = new controller();

if (isset($_GET['logout'])) $myPage->logout();
else if (!isset($_GET['goto'])) $myPage->index();
else if ($_GET['goto'] == 'createUser') $myPage->createUser();

?>

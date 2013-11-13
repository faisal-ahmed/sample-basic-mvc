<?php

/**
 * Description of controller
 *
 * @author Faisal Ahmed
 */
require_once 'userViewClass.php';
require_once 'model.php';

class controller {

    public function __construct() {
        
    }

    /**
     * Description of index()
     *
     * This function is responsible for the login
     */
    public function index() {
        if (isset($_SESSION['LOGGED_IN_STATUS']) && $_SESSION['LOGGED_IN_STATUS'] == TRUE) {
            $this->success();
            exit();
        }

        $view = new userViewClass();

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $view->render();
        } else {
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];

            $model = new model();
            $model->dbConnect('localhost', 'root', '', 'mvc_demo');
            $loginStatus = $model->loginCheck($username, $password);
            $model->dbClose();            

            if ($loginStatus == true) {
                $this->success();
                exit();
            } else {
                $data = array('message' => 'Username or password invalid.');
                $view->setData($data);
                $view->render();
            }
        }
    }

    /**
     * Description of createUser()
     *
     * This function is responsible for the creating a user
     */
    public function createUser() {
        $view = new userViewClass();
        $view->setContent('createUser.php');

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $view->render();
        } else {
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];

            $model = new model();
            $model->dbConnect('localhost', 'root', '', 'mvc_demo');
            $createUserStatus = $model->createUser($username, $password);
            $model->dbClose();

            if ($createUserStatus == true) {
                $data = array('message' => 'User has been created.');
                $view->setData($data);
                $view->render();
            } else {
                $data = array('message' => 'Database Error.');
                $view->setData($data);
                $view->render();
            }
        }
    }

    /**
     * Description of success()
     *
     * This function is responsible for the other view
     */
    public function success() {
        if (isset($_SESSION['LOGGED_IN_STATUS']) && $_SESSION['LOGGED_IN_STATUS'] == false) {
            $this->index();
            exit();
        }

        $data = array('username' => $_SESSION['USERNAME']);
        $view = new userViewClass();
        $view->setData($data);
        $view->setContent('success.php');
        $view->render();
    }

    /**
     * Description of logout()
     *
     * This function is responsible for the logout
     */
    public function logout() {
        if (isset($_SESSION['LOGGED_IN_STATUS']) && $_SESSION['LOGGED_IN_STATUS'] == false) {
            $this->index();
            exit();
        }
        session_destroy();
        session_start();
        header('Location: indexController.php');
        exit();
    }

}

?>

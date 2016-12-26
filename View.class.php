<?php
    class View
    {
        private $_actions;
        //private $_views;

        public function __construct()
        {
            $this->_actions = array(
                "access" => array("login", "signup", "reset", "signout"),
                "profile" => array("create", "view", "update")
            );
        }

        public function login()
        {
            require_once('login.php');
            $_SESSION['access'] = "login";
        }

        public function signup()
        {
            require_once('signup.php');
            $_SESSION['access'] = "signup";
        }

        public function signout()
        {
            //unset($_SESSION['login']);
            session_unset();
            //session_destroy();
            //require_once('index.php');
            header("location: index.php");
        }

        public function redirect($result)
        {
            $action = $_POST['action'];
            if ($action == "login")
            {
                if ($result)
                    require_once('views/profile.php');
                else
                   require_once('login.php');
            }
            elseif ($action == "signup")
            {
                if ($result)
                    require_once('login.php');
                else
                    require_once('signup.php');
            }
            else
                require_once('views/profile.php');
        }

        public function output($view, $action)
        {
            if (array_key_exists($view, $this->_actions) &&
                in_array($action, $this->_actions[$view]))
                $this->{$action}();
            else
                echo "Page not found";
        }
    }
?>
<?php
	class Controller
	{
		private $_actions;
		private $_model;

		public function __construct(Model $model)
		{
			$this->_model = $model;
			$this->_actions = array(
                "access" => array("login", "signup", "reset"),
                "profile" => array("create", "view", "update")
            );
		}

		public function login()
		{
			return $this->_model->login($_POST['username'], $_POST['passwd']);
		}

		public function signup()
		{
			return $this->_model->signup();
		}

		public function execute()
		{
			$controller = $_POST["controller"];
        	$action = $_POST["action"];

	        if (array_key_exists($controller, $this->_actions) &&
	        	in_array($action, $this->_actions[$controller]))
	            return $this->{$action}();
	        else
                echo "Page not found";
		}
	}
?>
<?php

class router {
 /*
 * @the registry
 */
 private $registry;

 /*
 * @the controller path
 */
 private $path;

 private $args = array();

 public $file;

 public $controller;

 public $action; 

 function __construct($registry) {
        $this->registry = $registry;
 }

 /**
 *
 * @set controller directory path
 *
 * @param string $path
 *
 * @return void
 *
 */
 function setPath($path) {

	/*** check if path i sa directory ***/
	if (is_dir($path) == false)
	{
		throw new Exception ('Invalid controller path: `' . $path . '`');
	}
	/*** set the path ***/
 	$this->path = $path;
}


 /**
 *
 * @load the controller
 *
 * @access public
 *
 * @return void
 *
 */
 public function loader()
 {
	/*** check the route ***/
	$this->getController();

	/*** if the file is not there diaf ***/
	if (is_readable($this->file) == false)
	{
		$this->file = $this->path.'/error404.php';
                $this->controller = 'error404';
	}

	/*** include the controller ***/
	include $this->file;

	/*** a new controller class instance ***/
	$class = $this->controller . 'Controller';
	$controller = new $class($this->registry);

	/*** check if the action is callable ***/
	if (is_callable(array($controller, $this->action)) == false)
	{
		$action = 'index';
	}
	else
	{
		$action = $this->action;
	}
	/*** run the action ***/
	if(!empty($this->args))
		$controller->$action($this->args);
	else
		$controller->$action();
 }


 /**
 *
 * @get the controller
 *
 * @access private
 *
 * @return void
 *
 */
private function getController() {

	/*** get the route from the url ***/
	$route = (empty($_GET['rt'])) ? '' : $_GET['rt'];

	if (empty($route))
	{
		$route = 'index';
	}
	else
	{
		/*** get the parts of the route ***/
		$parts = explode('/', $route);
		if($parts[0] == "login")
		{
			$this->controller = "member";
			$this->action = "login";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "register")
		{
			$this->controller = "member";
			$this->action = "register";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "deposit")
		{
			$this->controller = "member";
			$this->action = "deposit";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "giao-dich.html")
		{
			$this->controller = "page";
			$this->action = "trading";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "ho-so.html")
		{
			$this->controller = "page";
			$this->action = "profile";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "bao-mat.html")
		{
			$this->controller = "page";
			$this->action = "verify";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "cai-dat.html")
		{
			$this->controller = "page";
			$this->action = "setting";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "ngan-hang.html")
		{
			$this->controller = "page";
			$this->action = "banklist";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "nap-tien.html")
		{
			$this->controller = "page";
			$this->action = "deposit";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "rut-tien.html")
		{
			$this->controller = "page";
			$this->action = "withdraw";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "tai-khoan.html")
		{
			$this->controller = "page";
			$this->action = "account";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "lich-su-giao-dich.html")
		{
			$this->controller = "page";
			$this->action = "transactions";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "logout")
		{
			$this->controller = "member";
			$this->action = "logout";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "mylink")
		{
			$this->controller = "list";
			$this->action = "mylink";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "dashboard")
		{
			$this->controller = "index";
			$this->action = "dashboard";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		elseif($parts[0] == "dashboard2")
		{
			$this->controller = "index";
			$this->action = "dashboard2";
			if(isset( $parts[1]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 1; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
		
		else
		{
			$this->controller = $parts[0];
			if(isset( $parts[1]))
			{
				$this->action = $parts[1];
			}
			if(isset( $parts[2]))
			{
				$count_args = count($parts);
				$k = 1;
				$args = array();
				for($i = 2; $i < $count_args; $i++)
					$args[$k++] = $parts[$i]; 
				$this->args = $args;
			}
		}
	}

	if (empty($this->controller))
	{
		$this->controller = 'index';
	}

	/*** Get action ***/
	if (empty($this->action))
	{
		$this->action = 'index';
	}

	/*** set the file path ***/
	$this->file = $this->path .'/'. $this->controller . 'Controller.php';
}


}

?>

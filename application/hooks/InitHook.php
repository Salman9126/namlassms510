<?php
class InitHook
{
	var $CI,$isLoggedIn;
	function __construct(){
	  $this->CI = NULL;
	}
	function loadCustomCommonFunctions()
	{
		require_once(APPPATH.'third_party/functions.php');
	}

	function initPostController($code="")
	{
		$this->CI =& get_instance();
		$class = $this->CI->router->class;
		if($class <> "maintenence" && $this->isUnderMaintenence())
		{
			if($this->isLoggedIn())
			{
				$admin_SESSION_ID = intval($this->CI->session->userdata('admin_id'));
				$this->forceLogout($admin_SESSION_ID);
			}
			redirect(base_url()."maintenence/");
			return false;
		}
		else
		{
			$this->authenticateUser();
		}
	}
	function isLoggedIn()
	{
		$admin_SESSION_ID = intval($this->CI->session->userdata('admin_id'));

		if($admin_SESSION_ID > 0)
		{
			return true;
		}
		else
		{
			$this->CI->session->set_userdata('timezone','GMT');
			return false;
		}
	}
	//===================================================================================
    	function authenticateUser()
	{
		$class = $this->CI->router->class;

	  	$method = $this->CI->router->method;

		// before login controller array ex:- 'login'
	  	//(Note:- If you insert controller name here this rule will be apply to all methods inside it, if you want to add this rule for particular function within class then put controller/function name in beforeLoginControllerMethodArray array)
		$beforeLoginControllerArray = array (
			"login","dashboard"
		);

		//before login controller method array ex:- 'register/forgotpassword'
		//(Note:- If you insert controller/function name here this rule will be apply to particular function within class, if you want to add this rule for all methods inside controller then put controller name in beforeLoginControllerArray array)
		$beforeLoginControllerMethodArray = array (
			"register/forgotpassword"
		);

		// allways allow controller array ex:- 'home'
		//(Note:- If you insert controller name here this rule will be apply to all methods inside it, if you want to add this rule for particular function within class then put controller/function name in alwaysAllowControllerMethodArray array)
		$alwaysAllowControllerArray = array (
		                                           'home','four_zero_four','dashboard','members'
		);

		// allways allow controller method array ex:- 'product/details'
		//(Note:- If you insert controller/function name here this rule will be apply to particular function within class, if you want to add this rule for all methods inside controller then put controller name in alwaysAllowControllerArray array)
		$alwaysAllowControllerMethodArray = array (
		                                           'product/details'
		);

		// check always allow controller
		$returnMatch	=	$this->matchControllerMethod($alwaysAllowControllerArray,$alwaysAllowControllerMethodArray,$class,$method);

		if(!$returnMatch)
		{
			$returnMatch	=	$this->matchControllerMethod($beforeLoginControllerArray,$beforeLoginControllerMethodArray,$class,$method);
			if($returnMatch)
			{
				if($this->isLoggedIn())
				{
					redirect(base_url().'admin/dashboard');
					return false;
				}
			}
			else
			{
				if(!$this->isLoggedIn())
				{
					$this->CI->session->set_userdata('redirect_url', $this->CI->uri->uri_string);
					redirect(base_url()."login");
					return false;
				}
			}
		}

		if($this->isLoggedIn())
		{
			$this->CI->load->model('modelbasic');
			$admin_SESSION_ID = intval($this->CI->session->userdata('admin_id'));
			$admin_STATUS = $this->CI->modelbasic->getValueFromConditions('admin','status',array('id'=>$admin_SESSION_ID));
			//echo $admin_STATUS;die;
			if($admin_STATUS == "2" || $admin_STATUS == "3")
			{
				$this->forceLogout($admin_SESSION_ID);
				if($admin_STATUS == "2")
					$msg	=	"Your account is suspended. Contact admin for re-activation.";
				elseif($admin_STATUS == "3")
					$msg	=	"Your account is closed. Contact admin for re-activation.";
				$this->CI->session->set_userdata('error', $msg);
				redirect(base_url()."login");
				exit;
			}
		}

		if($this->CI->session->userdata('redirect_url') != '')
		{
			$redirect_url = base_url().$this->CI->session->userdata('redirect_url');
			$this->CI->session->unset_userdata('redirect_url');
			redirect($redirect_url);
			exit;
		}
	}

	function matchControllerMethod($alwaysAllowControllerArray,$allowControllerMethodArr,$class,$method)
	{
		$returnMatch	=	false;
		if(!empty($alwaysAllowControllerArray))
		{
			foreach($alwaysAllowControllerArray as $key)
			{
				if($key == $class)
				{
					$returnMatch	=	true;
				}
				else
				{
					if(!empty($allowControllerMethodArr))
					{
						foreach ($allowControllerMethodArr as $value)
						{
							$valueArr=explode('/', $value);
							if(isset($valueArr[0]) && $valueArr[0] == $class && isset($valueArr[1]) && $valueArr[1] == $method)
							{
								$returnMatch	=	true;
							}
						}
					}
				}
			}
		}
		return $returnMatch;
	}

	function forceLogout($loggedInUserId=0)
	{
		$this->CI->session->unset_userdata('admin_name');
		$this->CI->session->unset_userdata('admin_id');
		$this->CI->session->unset_userdata('admin_email');
		$this->CI->session->unset_userdata('admin_level');
		$this->CI->session->unset_userdata('picture');
	}

	function isUnderMaintenence()
	{
		$this->CI->load->model('modelbasic');
		$SITE_OFFLINE = $this->CI->modelbasic->getValueFromConditions('settings','description','type', 'SITE_OFFLINE');
		if($SITE_OFFLINE == "YES")
			return true;
		else
			return false;
	}
}
?>
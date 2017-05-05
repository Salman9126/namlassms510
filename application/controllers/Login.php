<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
/*	
*	@author : Salman Shaikh
*	date	: 15 April, 2017
*	Salman - Master Admin
*/
class Login extends CI_Controller
{
	function __construct()
	{
	    	parent::__construct();
	    	$this->load->library('form_validation');
	    	$this->load->model('modelbasic');
	    	$this->load->helper('string');
	}

	public function index()
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
		if ($this->form_validation->run())
		{
			$condition=array('email'=>$this->input->post('email'),'status'=>1,'password'=>md5($this->input->post('password')));
			$id=$this->modelbasic->getValueFromConditions('admin','id',$condition);
			if($id !='' && $id > 0)
			{
				if($this->input->post('remember')=="on")
				{
					$this->load->helper('cookie');
					$cookie = array(
									    'name'   => 'admin_id',
									    'value'  =>$id,
									    'expire' => '86500',
									);
					$this->input->set_cookie($cookie);
				}

				$userInfo=$this->modelbasic->getSelectedData('admin','*',array('id'=>$id),'','','','','','row');
				$data=array('admin_id'=>$userInfo->id,'admin_email'=>$userInfo->email,'admin_name'=>$userInfo->name,'admin_level'=>$userInfo->level,'picture'=>$userInfo->picture);
				$this->session->set_userdata($data);
				$data=array('status'=>'success','message'=>'Welcome to Dashboard');
				$data['ajax']=json_encode($data);
				//pr($data);
				//echo "Hi-3";die;
				$this->load->view('ajax_view',$data);
			}
			else
			{
				$data=array('status'=>'fail','message'=>'Invalid email address or password');
				$data['ajax']=json_encode($data);
				$this->load->view('ajax_view',$data);
			}
		}
		else
		{
			if($this->input->is_ajax_request())
			{
				//echo "Hi-1";die;
				$data['ajax']=$this->form_validation->get_json();
				$this->load->view('ajax_view',$data);
			}
			else
			{
				//echo "Hi-2";die;
				$this->load->view('login_view');
			}
		}
	}


	public function forgot_password()
	{
 		$this->form_validation->set_rules('emailId','Email','trim|required|valid_email|callback_email_check');
 		if($this->form_validation->run())
 		{
 			$email=$_POST['emailId'];
 			$condition=array('email'=>$email);
 			$adminId=$this->modelbasic->getValueFromConditions('admin','id',$condition);
 			$rand=random_string('unique', 16);
 			$data=array('pass_key'=>$rand);
 			$res=$this->modelbasic->_update('admin',$adminId,$data);
 			if($res >0 )
 			{
 				$adminInfo=$this->modelbasic->getSelectedData('admin','name,email', array('id'=>$adminId),'','','','','','row_array');
 				$template='Hello <b>'.$adminInfo['name']. '</b>,<br />To reset password for your Snagtag account "<br /><a href="'.base_url().'login/set_password/'.$rand.'">Click here.</a><br /><br /><br />Thanks,<br />Team Snagtag';
 				$emailData=array('to'=>$adminInfo['email'],'fromEmail'=>'demo@snagtagretail.com','subject'=>'Reset Password Link','template'=>$template);
 				$this->modelbasic->sendMail($emailData);
 				$this->session->set_flashdata('success', 'Reset password link is sent to your email id, please check email.');
 				redirect('login');
 			}
 			else
 			{
 				$this->session->set_flashdata('error', 'Failed to reset password.');
 				 redirect('login');
 			}
 		}

 		$this->load->view('forgot_password_view');
	}


	public function email_check($email)
 	{
 		$condition=array('email'=>$email);
 		$ch=$this->modelbasic->getValueFromConditions('admin','id',$condition);
 		if($ch == '')
 		{
 			$this->form_validation->set_message('email_check', 'Account with this email doesn’t exists, contact admin.');
			return FALSE;
		}
 		else
 		{
 			return TRUE;
 		}
 	}


	public function set_password($pass_key)
	{
		$res=$this->modelbasic->getValues('admin','id,email', 'pass_key',$pass_key);
		if(!empty($res))
		{
			$data['email']=$res['email'];
			$data['admin_id']=$res['id'];
			$this->load->view('set_password_view',$data);
		}
		else
		{
			$this->session->set_flashdata('error','Reset password link is expired.');
			redirect('login');
		}
	}

	public function updatepassword()
	{
		$this->form_validation->set_rules('password','Password','required|trim|xss_clean');
		$this->form_validation->set_rules('conf_password','Confirm Password','trim|required|matches[password]');
		if($this->form_validation->run())
		{
			$adminId=$_POST['admin_id'];
			$email=$_POST['email'];
			$data=array('password'=>md5($_POST['password']),'pass_key'=>'');
			$res=$this->modelbasic->_update('admin',$adminId,$data);
			if($res >0)
			{
				$this->session->set_flashdata('success','Password updated successfully');
				redirect('login');
			}
			else
			{
				$this->session->set_flashdata('error','Password not set.');
				redirect('login');
			}
		 }
		else
		{
			$this->load->view('set_password_view');
		}
	}


	function ajax_login()
	{
		$response = array();
		//Recieving post input of email, password from ajax request
		$email 		= $_POST["email"];
		$password 	= $_POST["password"];
		$response['submitted_data'] = $_POST;
		//Validating login
		$login_status = $this->validate_login( $email ,  $password );
		$response['login_status'] = $login_status;
		if ($login_status == 'success')
		{
			$response['redirect_url'] = '';
		}
		//Replying ajax request with validation response
		$data['ajax']=json_encode($response);
		$this->load->view('ajax_view',$data);
	}


    	//Validating login from ajax request
    	function validate_login($email	=	'' , $password	 =  '')
    	{
		 $credential	=	array(	'email' => $email , 'password' => $password );
		 $query = $this->db->get_where('admin' , $credential);
     		if ($query->num_rows() > 0)
		 {
         	$row = $query->row();
			$this->session->set_userdata('admin_login', '1');
			$this->session->set_userdata('admin_level', $row->level);
			$this->session->set_userdata('admin_id', $row->admin_id);
			$this->session->set_userdata('name', $row->name);
			$this->session->set_userdata('login_type', 'admin');
			$storeInfo=$this->product_model->getStoreInfo($row->store_id);
			$this->session->set_userdata('store_id',$storeInfo['id']);
			return 'success';
		}
		return 'invalid';
    }



	/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/
	function reset_password()
	{
		$account_type = $this->input->post('account_type');
		if ($account_type == "")
		{
			redirect(base_url(), 'refresh');
		}
		$email  = $this->input->post('email');
		$result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL
		if ($result == true)
		{
			$this->session->set_flashdata('flash_message', get_phrase('password_sent'));
		}
		else if ($result == false)
		{
			$this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
		}
		redirect(base_url(), 'refresh');
	}
    /*******LOGOUT FUNCTION *******/
}
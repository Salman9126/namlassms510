<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

/*	
*	@author : Salman Shaikh
*	date	: 15 April, 2017
*	Salman - Master Admin
*/
 
class Dashboard extends CI_Controller
{
      
	function __construct()
	{
    	parent::__construct();
    	//$this->load->model('admin/dashboard_model');
    	$this->load->model('modelbasic');
	}
	
	public function index()
	{
		/*$data['recent_comment']=$this->dashboard_model->project_comment();
		$data['user_data']=$this->dashboard_model->get_users_data();
		$data['all_project']=$this->dashboard_model->getAllProject();*/
		$data['page_title'] = 'Dashboard';
		$data['view'] = 'dashboard/dashboard_view';
		$this->load->view('admin/template/template',$data);
	}
	
	 public function comment_status()
	 {
	   if(isset($_POST['cid']) && ($_POST['cid'] !='') && isset($_POST['proid']) && ($_POST['proid'] !='') && isset($_POST['status']) && ($_POST['status'] !=''))
	   {
	   	 $res = $this->dashboard_model->change_comment_status($_POST['cid'],$_POST['status']);

		 if($_POST['status']==1)
		 {
		 	$this->dashboard_model->commentCountIncrement($_POST['proid']);
		 }
		 else
		 {
		   $this->dashboard_model->commentCountDecrement($_POST['proid']);
		 }

	 	 if($res>0)
		 {
		   echo 'yes';
		 }
		 else
		 {
		 	echo 'no';
		 }
	  }
	  else
	  {
	  	echo 'no';
	  }
    }
   
   	
   	function change_user_status()
	{
	  if(isset($_POST['userId']) && ($_POST['userId'] !='') && isset($_POST['status']) && ($_POST['status'] !=''))
	   {
			$result = $this->modelbasic->getValueFromConditions('users','status','id',$_POST['userId']);
			if($result == 1)
			{
				$data = array('status'=>'0');
			}else if($result == 0)
			{
				$data = array('status'=>'1');
			}
			$res = $this->modelbasic->_update('users',$_POST['userId'], $data);
			 if($res>0)
			 {
			   echo 'yes';
			 }
			 else
			 {
			 	echo 'no';
			 }
	   }
	     else
		  {
		  	echo 'no';
		  }	
	} 
	
	function logout()
	{
		$this->session->set_userdata('admin_login', '');
		$this->session->set_userdata('admin_id', '');
		$this->session->set_userdata('name', '');
		$this->session->set_userdata('login_type', '');
		$this->session->set_flashdata('logout_notification', 'logged_out');
		redirect(base_url().'login');
	} 
}

<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

/*	
*	@author : Salman Shaikh
*	date	: 15 April, 2017
*	Salman - Master Admin
*/
 
class Members extends CI_Controller
{
	function __construct()
	{
    	parent::__construct();
    	//$this->load->model('admin/dashboard_model');
    	$this->load->library('form_validation');
    	$this->load->model('modelbasic');
    	$this->load->helper('string');
    	$this->load->model('members_model');
	}
	
	public function index(){
		//echo "Hi";die;

		$data['page_title'] = 'Members Details';
		$data['view'] = 'members/manage_members_view';
		$this->load->view('admin/template/template',$data);
	}

	public function getFlatsData(){
		/*$i=1;
		while (1) {
			$i++;
		}*/
		$_POST['columns']='id,flatNo,firstName,contactNo,emailId,status';
		$requestData= $_REQUEST;
		//print_r($requestData);die;
		$columns=explode(',',$_POST['columns']);

		$selectColumns="id,flatNo,CONCAT(firstName, ' ', lastName) as name,middleName,contactNo,emailId,status,created_at,updated_at";
		//print_r($columns);die;
		
		//get total number of data without any condition and search term
		$totalData=$this->modelbasic->count_all_only('members');
		
		$totalFiltered=$totalData;

		//pass concatColumns only if you want search field to be fetch from concat
		$concatColumns='firstName,lastName';
		$whereConditions = array('memberType'=>1);
		$result=$this->modelbasic->run_query('members',$requestData,$columns,$selectColumns,$concatColumns,'',$whereConditions);
		//print_r($result);die;
		if( !empty($requestData['search']['value']) )
		{
			$totalFiltered=count($result);
		}
		$data = array();
		//print_r($result);die;
		if(!empty($result))
		{
			$i=1;
			foreach ($result as $row)
			{
				$nestedData=array();

				$nestedData['chk'] = '<input type="checkbox" class="case" id="check" name="checkall['.$row["id"].']" data-index="'.$row["id"].'">';
				$nestedData['id'] =$i+$requestData['start'];
				$nestedData['flatNo'] = $row["flatNo"];
				$nestedData['name'] = $row["name"];
				$nestedData['contactNo'] = $row["contactNo"];
				$nestedData['emailId'] = $row["emailId"];
				//$nestedData['created'] = date("d-m-Y",strtotime($row["created_at"]));
				
				
				if($row["status"]==1)
				{
					$nestedData['status'] = '<span class="label label-success" style="cursor: pointer;" onclick="change_status('.$row['id'].')">Active</span>';
				}
				elseif($row["status"]==0)
				{
					$nestedData['status'] = '<span class="label label-danger" onclick="change_status('.$row['id'].')" style="cursor: pointer;">Deactive</span>';
				}

				$nestedData['action'] = '<a class="btn menu-icon vd_bd-red vd_red" onclick="delete_members('.$row['id'].')" data-original-title="delete" data-toggle="tooltip" data-placement="top"><i class="fa fa-times"></i></a><a class="btn menu-icon vd_bd-blue vd_blue" onclick="sub_member_pop_up('."'".$row['flatNo']."'".')"  data-toggle="tooltip" data-placement="top"><i class="fa fa-fw fa-users"></i></a><a onclick="openEditForm('.$row['id'].')" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>';
				$data[] = $nestedData;
				$i++;
			}
		}

		$json_data = array(
				"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
				);
		//print_r($json_data);die;
		echo json_encode($json_data);die;
		//$this->load->view('admin/template/template',$data);
	}

	public function addNewFlatMember(){
		//echo "Hi";die;
		//print_r($_POST);die;
	
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('memberType', 'Member Type', 'required');
		if($_POST['memberType']==1){
			$this->form_validation->set_rules('flatNo', 'Flat No', 'required');
		}
		$this->form_validation->set_rules('firstName', 'First Name', 'required');
		$this->form_validation->set_rules('middleName', 'Middle Name', 'required');
		$this->form_validation->set_rules('lastName', 'Last Name', 'required');
		$this->form_validation->set_rules('contactNo', 'Contact No', 'required|integer');
		$this->form_validation->set_rules('alternateNo', 'Alternate No', 'integer');
		$this->form_validation->set_rules('emailId', 'Email ID', 'required');
		$this->form_validation->set_rules('photo', 'Photo', 'callback_image_upload');
		
		if ($this->form_validation->run())
		{
			
			if($this->input->post('memberId',TRUE) == '')
			{

				$newFlatInfo =array(
								 'firstName'=>$this->input->post('firstName',true),
								 'middleName'=>$this->input->post('middleName',true),
								 'lastName'=>$this->input->post('lastName',true),
								 'contactNo'=>$this->input->post('contactNo',true),
								 'alternateNo'=>$this->input->post('alternateNo',true),
								 'emailId'=>$this->input->post('emailId',true),
								 'memberType'=>$this->input->post('memberType',true),
								 'created_at'=>date("Y-m-d H:i:s")
								);
				if(isset($_POST['photo']['file_name']) && $_POST['photo']['file_name'] <> '')
				{
					$newFlatInfo['photo']=$_POST['photo']['file_name'];
				}
				if($this->input->post('flatNo',true)!=''){
					$newFlatInfo['flatNo'] = $this->input->post('flatNo',true);
					$this->modelbasic->_update('flats',$this->input->post('flatNo',true),array('availabilityStatus'=>1));
				}
				if($this->input->post('parentFlatID',true)!=''){
					$newFlatInfo['flatNo'] = $this->input->post('parentFlatID',true);
				}

				$res = $this->modelbasic->_insert('members',$newFlatInfo);
				if($res>0)
				{
					$data=array('status'=>'success','for'=>'add','message'=>'Member added successfully.');
				}
				else
				{
					$data=array('status'=>'fail','message'=>'Error occurred while adding member please try again....');
				}
			}else{
				$memberId = $_REQUEST['memberId'];
				$newFlatInfo =array('firstName'=>$this->input->post('firstName',true),
								 'middleName'=>$this->input->post('middleName',true),
								 'lastName'=>$this->input->post('lastName',true),
								 'contactNo'=>$this->input->post('contactNo',true),
								 'alternateNo'=>$this->input->post('alternateNo',true),
								 'emailId'=>$this->input->post('emailId',true)
								);
				if(isset($_POST['photo']['file_name']) && $_POST['photo']['file_name'] <> '')
				{
					$newFlatInfo['photo']=$_POST['photo']['file_name'];
				}
				if($this->input->post('flatNo',true)!=''){
					$newFlatInfo['flatNo'] = $this->input->post('flatNo',true);
				}
				if($this->input->post('parentFlatID',true)!=''){
					$newFlatInfo['flatNo'] = $this->input->post('parentFlatID',true);
				}

				$res = $this->modelbasic->_update('members',$memberId,$newFlatInfo);
				if($res)
				{
					$data=array('status'=>'success','for'=>'edit','message'=>'Member updating successfully.');
				}
				else
				{
					$data=array('status'=>'fail','message'=>'Error occurred while updating member please try again....');
				}
			}
			$data['ajax']=json_encode($data);
			$this->load->view('ajax_view',$data);
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
				$this->load->view('admin/member/manage_members_view');
			}
		}
	}


	public function normalMembers()
	{

		$data['flats'] = $this->members_model->getFlatNotAllocated();
		$data['page_title'] = 'Normal Members';
		$data['view'] = 'members/manage_members_view';
		$this->load->view('admin/template/template',$data);
	}

	public function committeeMembers()
	{
		$data['page_title'] = 'Committee Members';
		$data['view'] = 'members/manage_members_view';
		$this->load->view('admin/template/template',$data);
	}

	public function image_upload()
	{
		if(isset($_FILES['photo'])&&$_FILES['photo']['size'] != 0)
		{
			$upload_dir = './uploads/members/';
			if (!is_dir($upload_dir))
			{
			    mkdir($upload_dir);
			}
			$config['upload_path']   = $upload_dir;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['file_name']     = 'membersImage_'.substr(md5(rand()),0,7);
			/*$config['max_size']	 = '2000';
			$config['max_width']  = '900';
		    $config['max_height']  = '300';*/

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('photo'))
			{
				$this->form_validation->set_message('image_upload', $this->upload->display_errors());
				return false;
			}
			else
			{
				$_POST['photo'] =  $this->upload->data();
		        if(!is_dir('./uploads/members/thumb/'))
				{
					mkdir('./uploads/members/thumb/', 0777, TRUE);
				}
		        $config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/members/'.$_POST['photo']['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 600;
				$config['height'] = 200;
				$config['new_image'] = './uploads/members/thumb/'.$_POST['photo']['file_name'];
				$this->load->library('image_lib',$config);
				$return = $this->image_lib->resize();
				
				if($this->input->post('membersId',TRUE))
				{
					$query=$this->modelbasic->getValueFromConditions('members','photo','id',$this->input->post('membersId',TRUE));
					$path2 = './uploads/members/';
					$path3 = './uploads/members/thumb/';

					if(!empty($query))
					{
				    	unlink( $path2 . $query);
						unlink( $path3 . $query);
					}
				}
				
				return true;
			}
		}
		else
		{
			//$this->form_validation->set_message('image_upload', "No file selected");
			return true;
		}
	}

	public function getEditFormData()
	{
		$memberId=$this->input->post('memberId',true);
		$data=$this->modelbasic->get_where('members',$memberId)->row_array();
		//print_r($data);die;
		/*$data['close_on']= date("d-M-Y", strtotime($data["close_on"]));*/
		echo json_encode($data);die;
	}

	function multiselect_action()
	{
		//print_r($_POST);die;
		if(isset($_POST['submit'])){

			$check = $_POST['checkall'];

			//echo "<pre>";print_r($_POST);die;

			foreach ($check as $key => $value) {

				if($_POST['listaction'] == '1'){

					$status = array('status'=>'1');
					$this->modelbasic->_update('members',$key,$status);

					$this->session->set_flashdata('success', 'Member\'s activated successfully');


				}elseif($_POST['listaction'] == '2'){



						$status = array('status'=>'0');
					$this->modelbasic->_update('members',$key,$status);

						$this->session->set_flashdata('success', 'Member\'s deactivated successfully');

				}elseif($_POST['listaction'] == '3')
				{
					$query=$this->modelbasic->getValueFromConditions('members','photo','id',$key);
					//print_r($query);die;
					$path2 = './uploads/members/';
					$path3 = './uploads/members/thumb/';

					//echo($query);
					if(!empty($query))
					{
						//echo( $path2 . $query);die;
						unlink( $path2 . $query);
						unlink( $path3 . $query);
					}
					$this->modelbasic->_delete('members',$key);
					$this->session->set_flashdata('success', 'Member\'s deleted successfully');
				}
			}

			redirect('admin/members');
		}
	}

	function change_status($id = NULL)
	{
		$result = $this->modelbasic->getValue('members','status','id',$id);
		if($result == 1)
		{
			//echo "string1";die;
			$data = array('status'=>'0');
			if($id != 1)
			{
				$this->session->set_flashdata('success', 'Member deactivated successfully.');
			}
		}else if($result == 0)
		{
			//echo "string2";die;
			$data = array('status'=>'1');
			$this->session->set_flashdata('success', 'Member activated successfully.');
		}
		$this->modelbasic->_update('members',$id, $data);
		redirect('admin/members');
	}

	function delete_members($id = NULL)
	{
		$query=$this->modelbasic->getValueFromConditions('members','photo','id',$id);
        $path2 = './uploads/members/';
		$path3 = './uploads/members/thumb/';

		//echo($query);
		if(!empty($query))
		{
			//echo( $path2 . $query);die;
			unlink( $path2 . $query);
			unlink( $path3 . $query);
		}
		$this->modelbasic->_delete('members',$id);
		$this->session->set_flashdata('success', 'Member\'s deleted successfully');
		redirect('admin/members');
	}

}
?>
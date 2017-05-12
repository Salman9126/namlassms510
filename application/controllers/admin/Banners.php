<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

/*	
*	@author : Salman Shaikh
*	date	: 15 April, 2017
*	Salman - Master Admin
*/
 
class Banners extends CI_Controller
{
	function __construct()
	{
    	parent::__construct();
    	//$this->load->model('admin/dashboard_model');
    	$this->load->library('form_validation');
    	$this->load->model('modelbasic');
    	$this->load->helper('string');
    	//$this->load->model('Banners_model');
	}
	
	public function index(){
		//echo "Hi";die;

		$data['page_title'] = 'Banners Details';
		$data['view'] = 'banners/manage_banners_view';
		$this->load->view('admin/template/template',$data);
	}

	public function getBannersData(){
		/*$i=1;
		while (1) {
			$i++;
		}*/
		$_POST['columns']='id,name,banner,status';
		$requestData= $_REQUEST;
		//print_r($requestData);die;
		$columns=explode(',',$_POST['columns']);

		$selectColumns="id,name,banner,status,created_at,updated_at";
		//print_r($columns);die;
		
		//get total number of data without any condition and search term
		$totalData=$this->modelbasic->count_all_only('tbl_banners');
		
		$totalFiltered=$totalData;

		//pass concatColumns only if you want search field to be fetch from concat
		$concatColumns='';
		$whereConditions = array();
		$result=$this->modelbasic->run_query('tbl_banners',$requestData,$columns,$selectColumns,$concatColumns,'',$whereConditions);
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
				$nestedData['name'] = $row["name"];
				$nestedData['banner'] = '<img src="'.base_url('uploads/banners/thumb/').'/'.$row["banner"].'" style="width:100px;">';
				$nestedData['created'] = date("d-m-Y",strtotime($row["created_at"]));
				
				
				if($row["status"]==1)
				{
					$nestedData['status'] = '<span class="label label-success" style="cursor: pointer;" onclick="change_status('.$row['id'].')">Active</span>';
				}
				elseif($row["status"]==0)
				{
					$nestedData['status'] = '<span class="label label-danger" onclick="change_status('.$row['id'].')" style="cursor: pointer;">Deactive</span>';
				}

				$nestedData['action'] = '<a class="btn menu-icon vd_bd-red vd_red" onclick="delete_banners('.$row['id'].')" data-original-title="delete" data-toggle="tooltip" data-placement="top"><i class="fa fa-times"></i></a><a onclick="openEditForm('.$row['id'].')" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>';
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

	public function addNewBanner(){
		//echo "Hi";die;
		//print_r($_POST);die;
	
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('banner', 'Banner', 'callback_image_upload');
		
		if ($this->form_validation->run())
		{
			
			if($this->input->post('bannerId',TRUE) == '')
			{

				$newBannerInfo =array(
								 'name'=>$this->input->post('name',true),
								 'created_at'=>date("Y-m-d H:i:s")
								);
				if(isset($_POST['banner']['file_name']) && $_POST['banner']['file_name'] <> '')
				{
					$newBannerInfo['banner']=$_POST['banner']['file_name'];
				}
				
				$res = $this->modelbasic->_insert('tbl_banners',$newBannerInfo);
				if($res>0)
				{
					$data=array('status'=>'success','for'=>'add','message'=>'Banner added successfully.');
				}
				else
				{
					$data=array('status'=>'fail','message'=>'Error occurred while adding banner please try again....');
				}
			}else{
				$bannerId = $_REQUEST['bannerId'];
				$newBannerInfo =array(
								 'name'=>$this->input->post('name',true),
								 'created_at'=>date("Y-m-d H:i:s")
								);
				if(isset($_POST['banner']['file_name']) && $_POST['banner']['file_name'] <> '')
				{
					$newBannerInfo['banner']=$_POST['banner']['file_name'];
				}
				
				$res = $this->modelbasic->_update('tbl_banners',$bannerId,$newBannerInfo);
				if($res)
				{
					$data=array('status'=>'success','for'=>'edit','message'=>'Banner updating successfully.');
				}
				else
				{
					$data=array('status'=>'fail','message'=>'Error occurred while updating banner please try again....');
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
				$this->load->view('admin/banner/manage_banners_view');
			}
		}
	}


	public function normalBanners()
	{

		$data['flats'] = $this->Banners_model->getFlatNotAllocated();
		$data['page_title'] = 'Normal Banners';
		$data['view'] = 'Banners/manage_banners_view';
		$this->load->view('admin/template/template',$data);
	}

	public function committeeBanners()
	{
		$data['page_title'] = 'Committee Banners';
		$data['view'] = 'Banners/manage_banners_view';
		$this->load->view('admin/template/template',$data);
	}

	public function image_upload()
	{
		if(isset($_FILES['banner'])&&$_FILES['banner']['size'] != 0)
		{
			$upload_dir = './uploads/banners/';
			if (!is_dir($upload_dir))
			{
			    mkdir($upload_dir);
			}
			$config['upload_path']   = $upload_dir;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['file_name']     = 'BannersImage_'.substr(md5(rand()),0,7);
			/*$config['max_size']	 = '2000';
			$config['max_width']  = '900';
		    $config['max_height']  = '300';*/

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('banner'))
			{
				$this->form_validation->set_message('image_upload', $this->upload->display_errors());
				return false;
			}
			else
			{
				$_POST['banner'] =  $this->upload->data();
		        if(!is_dir('./uploads/banners/thumb/'))
				{
					mkdir('./uploads/banners/thumb/', 0777, TRUE);
				}
		        $config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/banners/'.$_POST['banner']['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 600;
				$config['height'] = 200;
				$config['new_image'] = './uploads/banners/thumb/'.$_POST['banner']['file_name'];
				$this->load->library('image_lib',$config);
				$return = $this->image_lib->resize();
				
				if($this->input->post('BannersId',TRUE))
				{
					$query=$this->modelbasic->getValueFromConditions('tbl_banners','banner','id',$this->input->post('bannersId',TRUE));
					$path2 = './uploads/Banners/';
					$path3 = './uploads/Banners/thumb/';

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
		$bannerId=$this->input->post('bannerId',true);
		$data=$this->modelbasic->get_where('tbl_banners',$bannerId)->row_array();
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
					$this->modelbasic->_update('tbl_banners',$key,$status);

					$this->session->set_flashdata('success', 'Banner\'s activated successfully');


				}elseif($_POST['listaction'] == '2'){



					$status = array('status'=>'0');
					$this->modelbasic->_update('tbl_banners',$key,$status);

					$this->session->set_flashdata('success', 'Banner\'s deactivated successfully');

				}elseif($_POST['listaction'] == '3')
				{
					$query=$this->modelbasic->getValueFromConditions('tbl_banners','banner','id',$key);
					//print_r($query);die;
					$path2 = './uploads/Banners/';
					$path3 = './uploads/Banners/thumb/';

					//echo($query);
					if(!empty($query))
					{
						//echo( $path2 . $query);die;
						unlink( $path2 . $query);
						unlink( $path3 . $query);
					}
					$this->modelbasic->_delete('tbl_banners',$key);
					$this->session->set_flashdata('success', 'Banner\'s deleted successfully');
				}
			}

			redirect('admin/banners');
		}
	}

	function change_status($id = NULL)
	{
		$result = $this->modelbasic->getValue('tbl_banners','status','id',$id);
		if($result == 1)
		{
			//echo "string1";die;
			$data = array('status'=>'0');
			if($id != 1)
			{
				$this->session->set_flashdata('success', 'Banner deactivated successfully.');
			}
		}else if($result == 0)
		{
			//echo "string2";die;
			$data = array('status'=>'1');
			$this->session->set_flashdata('success', 'Banner activated successfully.');
		}
		$this->modelbasic->_update('tbl_banners',$id, $data);
		redirect('admin/banners');
	}

	function delete_Banners($id = NULL)
	{
		$query=$this->modelbasic->getValueFromConditions('tbl_banners','banner','id',$id);
        $path2 = './uploads/Banners/';
		$path3 = './uploads/Banners/thumb/';

		//echo($query);
		if(!empty($query))
		{
			//echo( $path2 . $query);die;
			unlink( $path2 . $query);
			unlink( $path3 . $query);
		}
		$this->modelbasic->_delete('tbl_banners',$id);
		$this->session->set_flashdata('success', 'Banner\'s deleted successfully');
		redirect('admin/banners');
	}

}
?>
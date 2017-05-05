<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

/*	
*	@author : Salman Shaikh
*	date	: 15 April, 2017
*	Salman - Master Admin
*/
 
class Flats extends CI_Controller
{
	function __construct()
	{
    	parent::__construct();
    	//$this->load->model('admin/dashboard_model');
    	$this->load->library('form_validation');
    	$this->load->model('modelbasic');
    	$this->load->helper('string');
	}
	
	public function index(){
		//echo "Hi";die;
		$data['page_title'] = 'Flats Detail';
		$data['view'] = 'flats/manage_flats_view';
		$this->load->view('admin/template/template',$data);
	}

	public function getFlatsData(){
		/*$i=1;
		while (1) {
			$i++;
		}*/
		$_POST['columns']='id,flatNo,wingPhase,flatSize,flatType,created_at,status';
		$requestData= $_REQUEST;
		//print_r($requestData);die;
		$columns=explode(',',$_POST['columns']);

		$selectColumns="id,flatNo,wingPhase,flatSize,flatType,status,created_at,updated_at";
		//print_r($columns);die;
		
		//get total number of data without any condition and search term
		$totalData=$this->modelbasic->count_all_only('flats');
		
		$totalFiltered=$totalData;

		//pass concatColumns only if you want search field to be fetch from concat
		$concatColumns='';
		$result=$this->modelbasic->run_query('flats',$requestData,$columns,$selectColumns,$concatColumns,'');
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
				$nestedData['wingPhase'] = $row["wingPhase"];
				$nestedData['flatSize'] = $row["flatSize"];
				$nestedData['flatType'] = $row["flatType"];
				$nestedData['created'] = date("d-m-Y",strtotime($row["created_at"]));
				
				
				if($row["status"]==1)
				{
					$nestedData['status'] = '<span class="label label-success" style="cursor: pointer;" onclick="change_status('.$row['id'].')">Active</span>';
				}
				elseif($row["status"]==0)
				{
					$nestedData['status'] = '<span class="label label-danger" onclick="change_status('.$row['id'].')" style="cursor: pointer;">Deactive</span>';
				}

				$nestedData['action'] = '<a class="btn menu-icon vd_bd-red vd_red" onclick="delete_confirm('.$row['id'].')" data-original-title="delete" data-toggle="tooltip" data-placement="top"><i class="fa fa-times"></i></a>';
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

	public function addNewFlat(){
		//echo "Hi";die;
		//print_r($_POST);die;
	
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('flatNo', 'Flat No', 'required|is_unique[flats.flatNo]');
		$this->form_validation->set_rules('wingPhase', 'Wing/Phase', 'required');
		$this->form_validation->set_rules('flatSize', 'Flat Size', 'required|decimal|numeric');
		$this->form_validation->set_rules('flatType', 'Flat Type', 'required');
		
		if ($this->form_validation->run())
		{
			$newFlatInfo =array('flatNo'=>$this->input->post('flatNo',true),
							 'wingPhase'=>$this->input->post('wingPhase',true),
							 'flatSize'=>$this->input->post('flatSize',true),
							 'flatType'=>$this->input->post('flatType',true),
							 'created_at'=>date("Y-m-d H:i:s")
							);
			$newFlatId = $this->modelbasic->_insert('flats',$newFlatInfo);
			if($newFlatId !='' && $newFlatId > 0)
			{
				$data=array('status'=>'success','message'=>'New Flat Added Successfully!');
				$data['ajax']=json_encode($data);
				$this->load->view('ajax_view',$data);
			}
			else
			{
				$data=array('status'=>'fail','message'=>'Fail to add new flat. Please try again.');
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

}
?>
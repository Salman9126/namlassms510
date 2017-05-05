<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Members_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getFlatNotAllocated(){

		/*$this->db->select('flatNo');
		$this->db->from('members');
		$membersFlatNo = $this->db->get()->result_array();

		foreach ($membersFlatNo as $val) {
			$flatNo[]=$val['flatNo'];
		}
		//print_r($flatNo);die;*/
		$this->db->select('*');
		$this->db->from('flats');
		//$this->db->join('members as M','M.flatNo = F.flatNo','outer');
		$this->db->where('availabilityStatus',0);
		$result = $this->db->get()->result_array();
		//print_r($data);die;
		return $result;
	}
}
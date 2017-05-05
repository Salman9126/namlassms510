<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Modelbasic extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/* START: Datatable Function*/
		  
  	function make_query()  
  	{  
       $this->db->select($this->select_column);  
       $this->db->from($this->table);  
       if(isset($_POST["search"]["value"]))  
       {  
            $this->db->like("first_name", $_POST["search"]["value"]);  
            $this->db->or_like("last_name", $_POST["search"]["value"]);  
       }  
       if(isset($_POST["order"]))  
       {  
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
       }  
       else  
       {  
            $this->db->order_by('id', 'DESC');  
       }  
  	}  
  	function make_datatables(){  
       $this->make_query();  
       if($_POST["length"] != -1)  
       {  
            $this->db->limit($_POST['length'], $_POST['start']);  
       }  
       $query = $this->db->get();  
       return $query->result();  
  	}  
  	function get_filtered_data(){  
       $this->make_query();  
       $query = $this->db->get();  
       return $query->num_rows();  
  	}       
  	function get_all_data()  
  	{  
       $this->db->select("*");  
       $this->db->from($this->table);  
       return $this->db->count_all_results();  
  	}  

    /* END: Datatable Function*/


	//get all data from table (optional order by)
	function get($table,$order_by='',$dir='')
	{
		if($order_by != '')
		{
			$this->db->order_by($order_by,$dir);
		}
		$query=$this->db->get($table);
		return $query;
	}

	//get selected data from table (optional condition array, order by, group by, limit, offset, result methos)
	public function getSelectedData($table,$selectString,$conditionArray='',$orderBy='',$dir='',$groupBy='',$limit='',$offset='',$resultMethod='')
	{
		$this->db->select($selectString);
		$this->db->from($table);
		if(is_array($conditionArray) && !empty($conditionArray))
		{
			foreach ($conditionArray as $key => $value)
			{
				$this->db->where($key,$value);
			}
		}

		if($limit != '')
		{
			$this->db->limit($limit);
		}

		if($offset != '')
		{
			$this->db->offset($offset);
		}

		if($orderBy != '')
		{
			$this->db->order_by($orderBy,$dir);
		}

		if($groupBy != '')
		{
			$this->db->group_by($groupBy);
		}

		if($resultMethod != '')
		{
			if($resultMethod == 'row')
			{
				return $this->db->get()->row();
			}
			elseif ($resultMethod == 'row_array')
			{
				return $this->db->get()->row_array();
			}
		}
		else
		{
			return $this->db->get()->result_array();
		}

	}

	//get single value from table with condition as array
	function getValueFromConditions($table,$getColumn,$conditionArray)
	{
		$this->db->select($getColumn);
		$this->db->from($table);
		if(is_array($conditionArray) && !empty($conditionArray))
		{
			foreach ($conditionArray as $key => $value)
			{
				$this->db->where($key,$value);
			}
		}

		$result=$this->db->get()->row();
		if(!empty($result))
		{
			return $result->$getColumn;
		}
		else
		{
			return '';
		}
	}

	function getValue($table,$getColumn,$fieldName, $fieldValue)
	{
		$this->db->select($getColumn);
		$this->db->from($table);
		$this->db->where($fieldName,$fieldValue);
		$result=$this->db->get()->row();
		if(!empty($result))
		{
			return $result->$getColumn;
		}
		else
		{
			return '';
		}

	}

	public function getValuewithCondition($table_name="",$field_name="",$condition="")
	{
		//echo $field_name;die;
		$query 	= "SELECT
						".$field_name."
					FROM
						".$table_name;
		if($condition <> "")
		{
			$query 	.= " WHERE ".$condition;
		}

		$result = $this->db->query($query);
		//echo $this->db->last_query();die;
		if($result)
		{
			$recordSet 	= $result->row_array();
			if(count($recordSet) > 0)
			{
				return $recordSet[$field_name];
			}
		}
		return false;
	}

	function getValueWhere($table,$getColumn,$condition)
	{
		$this->db->select($getColumn);
		$this->db->from($table);

		foreach ($condition as $key => $value)
		{
			$this->db->where($key,$value);
		}

		$result=$this->db->get()->row();
		if(!empty($result))
		{
			return $result->$getColumn;
		}
		else
		{
			return 0;
		}

	}

	function getValueOrWhere($table,$getColumn,$condition)
	{
		$this->db->select($getColumn);
		$this->db->from($table);

		foreach ($condition as $key => $value)
		{
			$this->db->where($key,$value);
		}

		$result=$this->db->get()->row();
		if(!empty($result))
		{
			return $result->$getColumn;
		}
		else
		{
			return 0;
		}

	}

	function get_with_limit($table,$limit, $offset, $order_by){

		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query=$this->db->get($table);
		return $query;
	}

	function get_where($table,$id){

		$this->db->where('id', $id);
		$query=$this->db->get($table);
		return $query;
	}

	function get_where_custom($table,$col, $value){

		$this->db->where($col, $value);
		$query=$this->db->get($table);
		return $query;
	}

	function _insert($table,$data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	function _error($act)
	{
		 return json_encode(array("success" => "0","action" => $act));
	}

	function _update($table,$id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}
	function _update_custom($table,$field,$value, $data)
	{
		$this->db->where($field, $value);
		return $this->db->update($table, $data);
	}
	function _delete($table,$id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($table);
	}

	function _deleteAll($table)
	{
		return $this->db->empty_table($table);;
	}

	function _delete_with_condition($table,$condi,$id)
	{
		$this->db->where($condi, $id);
		$this->db->delete($table);
	}

	function _delete_with_conditions($table,$condition)
	{
		foreach ($condition as $key => $value)
		{
			$this->db->where($key,$value);
		}
		return $this->db->delete($table);
	}

	function count_where($table,$column, $value)
	{
		$this->db->where($column, $value);
		$query=$this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function count_all($table)
	{
		$query=$this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function count_all_only($table,$condition='',$separator="AND")
	{
		if($condition<>'')
		{
			$i=0;
			foreach ($condition as $key => $value)
			{
				if($separator=='AND')
				{
					$this->db->where($key,$value);
				}
				else
				{
					if($i==0)
					{
						$this->db->where($key,$value);
					}
					else
					{
						$this->db->or_where($key,$value);
					}
				}
				$i++;
			}
		}
		$num_rows = $this->db->count_all_results($table);
		return $num_rows;
	}

	function get_max($table)
	{
		$this->db->select_max('id');
		$query = $this->db->get($table);
		$row=$query->row();
		$id=$row->id;
		return $id;
	}
	function _custom_query($table,$mysql_query)
	{
		$query = $this->db->query($mysql_query);
		return $query;
	}

	function run_query($table,$requestData,$columns,$selectColumns,$concatColumns = '',$fieldName='',$whereConditions='')
	{
		$this->db->select($selectColumns,FALSE)->from($table);
		if(!empty($whereConditions) && is_array($whereConditions)){
			$this->db->where($whereConditions);
		}
			$i=0;
			if( !empty($requestData['search']['value']) )
			{
				foreach ($columns as $value)
				{
					if($i==0)
					{
						$this->db->like($value,$requestData['search']['value'],'both');
					}
					else
					{
						if($concatColumns <> '' && $value == $fieldName)
						{
							$concat=explode(',', $concatColumns);
							$this->db->or_like("CONCAT($concat[0],' ', $concat[1])", $requestData['search']['value'], 'both',FALSE);
						}
						else
						{
							$this->db->or_like($value,$requestData['search']['value'],'both');
						}
					}
					$i++;
				}
			}
			if(!empty($requestData["order"]))
			{
				if($requestData["order"][0]["column"] > 1)
				{
					$orderby=$requestData["order"][0]["column"]-1;
				}
				else
				{
					$orderby=3;
				}
				if($columns[$orderby] != '')
				{
					$orderByField=$columns[$orderby];
					//echo $orderByField;die;
					$orderByDirection=$requestData["order"][0]["dir"];
				}
				else
				{
					$orderByField='created_at';
					$orderByDirection='desc';
				}
			}
			else
			{
				$orderByField='created_at';
				$orderByDirection='desc';
			}

			$this->db->order_by($orderByField,$orderByDirection);

			if($requestData["length"] != -1)
			{
				$this->db->limit($requestData["length"],$requestData["start"]);
			}

			return $this->db->get()->result_array();
	}

	function getAllWhere($table,$fields,$condition="",$orderby='',$dir='')
	{
		$this->db->select($fields);
		$this->db->from($table);
		if($condition !='')
		{
			foreach ($condition as $key => $value)
			{
				$this->db->where($key,$value);
			}
		}
		if($orderby!='')
		{
			$this->db->order_by($orderby,$dir);
		}
		return $this->db->get()->result_array();
	}


	public function sendMail($data)
	{
		$localhost = array(
							    '127.0.0.1',
							    '::1'
							);
		$this->load->library('email');
		$config = Array(
			              'mailtype' => 'html',
			              'priority' => '3',
			              'charset'  => 'iso-8859-1',
			              'validate'  => TRUE ,
			              'newline'   => "\r\n",
			              'wordwrap' => TRUE
			              );
		if(in_array($_SERVER['REMOTE_ADDR'], $localhost))
		{
		    	$config['protocol']='smtp';
		    	$config['smtp_host']='ssl://smtp.googlemail.com';
		    	$config['smtp_port']='465';
		    	$config['smtp_user']='test.unichronic@gmail.com';
		    	$config['smtp_pass']='unichronic123';
			    $config['mailtype']='html';
		}
				$this->email->initialize($config);
				/*if(isset($data['fromEmail']) && $data['fromEmail']!='')
				{
					$fromEmail 	=	$this->getValueFromConditions($this->db->dbprefix('admin_users'),"email"," `id` = '1' ");
				}*/
				$fromName 	=	'Snagtag Admin';
				$this->email->clear(TRUE);
				$this->email->to($data['to']);
				$this->email->from($data['fromEmail'],$fromName);
				$this->email->subject($data['subject']);
				$this->email->message($data['template']);
				/*$this->email->send();
				echo $this->email->print_debugger();*/
				 if($this->email->send())
					return true;
				else
					return false;
	}

	public function sendMailWithAttachment($data)
	{
		$localhost = array(
				    '127.0.0.1',
				    '::1'
				);
		$this->load->library('email');
		$config = Array(
			              'mailtype' => 'html',
			              'priority' => '3',
			              'charset'  => 'iso-8859-1',
			              'validate'  => TRUE ,
			              'newline'   => "\r\n",
			              'wordwrap' => TRUE
				              );
				if(in_array($_SERVER['REMOTE_ADDR'], $localhost))
				{
				    	$config['protocol']='smtp';
				    	$config['smtp_host']='ssl://smtp.googlemail.com';
				    	$config['smtp_port']='465';
				    	$config['smtp_user']='test.unichronic@gmail.com';
				    	$config['smtp_pass']='unichronic123';
				    	$config['mailtype']='html';
				}
				//print_r($config);die;
				$this->email->initialize($config);
				$attachment='./uploads/winner_certificate/'.$data['attachment'];
				$fromName 	=	'Snagtag Admin';
				$this->email->clear(TRUE);
				$this->email->to($data['to']);
				$this->email->from($data['from'],$fromName);
				$this->email->subject($data['subject']);
				$this->email->message($data['template']);
				$this->email->attach($attachment);
				if($this->email->send())
				{
				 	return true;
				}
				else
				{
					return false;
				}
	}

	function uniResize($source_image_path, $destination_image_path, $tn_w, $tn_h, $quality = 100, $wmsource = false)
	{
	    $image_size_info = getimagesize($source_image_path);

	    $imgtype = image_type_to_mime_type($image_size_info[2]);
	    //get mime type of image
	    #assuming the mime type is correct
	    switch ($imgtype) {
	        case 'image/jpeg':
	            $source = imagecreatefromjpeg($source_image_path);
	            break;
	        case 'image/gif':
	            $source = imagecreatefromgif($source_image_path);
	            break;
	        case 'image/png':
	            $source = imagecreatefrompng($source_image_path);
	            break;
	        default:
	            die('Invalid image type.');
	    }
	    #Figure out the dimensions of the image and the dimensions of the desired thumbnail
	    $src_w = imagesx($source);
	    $src_h = imagesy($source);
	    #Do some math to figure out which way we'll need to crop the image
	    #to get it proportional to the new size, then crop or adjust as needed
	    $x_ratio = $tn_w / $src_w;
	    $y_ratio = $tn_h / $src_h;
	    if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
	        $new_w = $src_w;
	        $new_h = $src_h;
	    } elseif (($x_ratio * $src_h) < $tn_h) {
	        $new_h = ceil($x_ratio * $src_h);
	        $new_w = $tn_w;
	    } else {
	        $new_w = ceil($y_ratio * $src_w);
	        $new_h = $tn_h;
	    }
	    $newpic = imagecreatetruecolor(round($new_w), round($new_h));
	    imagealphablending( $newpic, false );
	    imagesavealpha( $newpic, true );
	    imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
	    $final = imagecreatetruecolor($tn_w, $tn_h);
	    $black = imagecolorallocate($final, 0, 0, 0);
	    $backgroundColor = imagecolortransparent($final, $black);
	    //imagefill($final, 0, 0, $backgroundColor);
	    //imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
	    imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);
	    #if we need to add a watermark
	    if ($wmsource) {
	        #find out what type of image the watermark is
	        $image_size_info    = getimagesize($wmsource);
	        $imgtype = image_type_to_mime_type($image_size_info[2]);
	        #assuming the mime type is correct
/*	        switch ($imgtype) {
	            case 'image/jpeg':
	                $watermark = imagecreatefromjpeg($wmsource);
	                break;
	            case 'image/gif':
	                $watermark = imagecreatefromgif($wmsource);
	                break;
	            case 'image/png':
	                $watermark = imagecreatefrompng($wmsource);
	                break;
	            default:
	                die('Invalid watermark type.');
	        }*/
	        $watermark = imagecreatefrompng($wmsource);
	        #if we're adding a watermark, figure out the size of the watermark
	        #and then place the watermark image on the bottom right of the image
	        $wm_w = imagesx($watermark);
	        $wm_h = imagesy($watermark);
	        imagecopy($final, $watermark, $tn_w - $wm_w, $tn_h - $wm_h, 0, 0, $tn_w, $tn_h);
	    }
	    if (imagepng($final, $destination_image_path, 9)) {
	        return true;
	    }
	    return false;
	}

}
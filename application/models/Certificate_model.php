<?php
Class Certificate_model extends CI_Model
{

    function certificate_list($limit,$stat='0'){
	  
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['certificate_gen']);
		if(in_array('List',$acp)){
			$gid=$logged_in['gid'];
			$uid=$logged_in['uid'];
			$query=$this->db->query("select * , (select concat(first_name,' ',last_name) from savsoft_users where uid = a.uid) as wine from certificate_upload a where uid='$uid' ORDER BY cid DESC LIMIT $stat OFFSET $limit");
			return $user=$query->result_array();
		}	

		
				
		if($this->input->post('search') && in_array('List_all',$acp)){
			$search=$this->input->post('search');
			$this->db->or_where('quid',$search);
			$this->db->or_like('quiz_name',$search);
			$this->db->or_like('description',$search);
		}
		
		
		if(in_array('List_all',$acp)){
			$gid=$logged_in['gid'];
			$uid=$logged_in['uid'];
			$query=$this->db->query("select * , (select concat(first_name,' ',last_name) from savsoft_users where uid = a.uid) as wine from certificate_upload a ORDER BY cid DESC LIMIT $stat OFFSET $limit");
			return $user=$query->result_array();
		}	
		
	 
		// $this->db->limit($this->config->item('number_of_rows'),$limit);
		// $this->db->order_by('cid','desc');
		// $query=$this->db->get('certificate_upload');
		// return $query->result_array();
	 
 	}





	 function remove_certificate($cid){
	 
		$this->db->where('cid',$cid);
		if($this->db->delete('certificate_upload')){
			
			return true;
		}else{
			
			return false;
		}
		
		
	}








	function insert_certificate($uploaded){
		$userdata=array(
		'uid'=>$this->input->post('user'),
		'licence_number'=>$this->input->post('lno'),
		'session'=>$this->input->post('session'),
		'course'=>$this->input->post('course'),
		'status'=>$this->input->post('status'),
		'file'=>$uploaded,
		'timestamp'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('certificate_upload',$userdata);
		$cid=$this->db->insert_id();
		return $cid;
	}

 



}
?>

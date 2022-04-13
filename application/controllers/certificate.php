<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
	   $this->load->helper(array('form', 'url')); 
	   $this->load->model("certificate_model");
	   $this->load->model("user_model");
	   $this->lang->load('basic', $this->config->item('language'));

	 }

	public function index($limit='0',$list_view='grid',$stat='30')
	{
		// print_r($limit);
		// print_r($list_view);
		// print_r($stat);exit;
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			redirect('login');
        }
        
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');		
		redirect('login');
		}
        
        // print_r(base_url());exit;
		
		
		 	
			$logged_in=$this->session->userdata('logged_in');
            $setting_p=explode(',',$logged_in['certificate_gen']);
			if(in_array('List',$setting_p) || in_array('List_all',$setting_p)){
			
			}else{
			exit($this->lang->line('permission_denied'));
			}
			 
			
        // print_r($list_view);exit;
            
        

		$data['list_view']=$list_view;
		$data['limit']=$limit;
		$data['title']=$this->lang->line('certificate_title');
		// fetching quiz list
		$data['result']=$this->certificate_model->certificate_list($limit,$stat);
		$this->load->view('header',$data);
		$this->load->view('certificate_list',$data);
		$this->load->view('footer',$data);
	}
	





	public function remove_certificate($cid){

		$logged_in=$this->session->userdata('logged_in');
					$acp=explode(',',$logged_in['certificate_gen']);
		if(!in_array('Remove',$acp)){
		exit($this->lang->line('permission_denied'));
		} 
		
		if($this->certificate_model->remove_certificate($cid)){
					$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
				}else{
						$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
					
				}
				redirect('certificate');
				 
		
	}









	public function new_certificate(){

		// print_r($limit);
		// print_r($list_view);
		// print_r($stat);exit;
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			redirect('login');
        }
        
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');		
		redirect('login');
		}
        
        // print_r(base_url());exit;
		
		
		 	
			$logged_in=$this->session->userdata('logged_in');
            $setting_p=explode(',',$logged_in['certificate_gen']);
			if(in_array('Add',$setting_p)){
			
			}else{
				exit($this->lang->line('permission_denied'));
			}

		$data['title']=$this->lang->line('certificate_title');
		$data['user_list']=$this->user_model->user_list_all();
		$this->load->view('header',$data);
		$this->load->view('new_certificate',$data);
		$this->load->view('footer',$data);
		
	}
	


		
	
	public function insert_certificate()
	{
				// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			redirect('login');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');		
		redirect('login');
		}
		
	 
	
	
		
			$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['quiz']);
			if(!in_array('Add',$acp)){
			exit($this->lang->line('permission_denied'));
			}
			
			
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|pdf';
			$config['max_size'] = 20000;
			$config['max_width'] = 15000;
			$config['max_height'] = 15000;
			$this->load->library('upload', $config);
			// $this->upload->do_upload('file');
			// $this->upload->do_upload('file');

			if ( ! $this->upload->do_upload('file') ) {
				// $error = array('error' => $this->upload->display_errors()); 
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>Select document to continue.</div>");
				redirect('certificate/new_certificate/');
			}
			else { 
				$data = array('upload_data' => $this->upload->data());
			} 
			$uploaded = $data["upload_data"]["file_name"];
			// print_r($uploaded);exit;

		$this->load->library('form_validation');
		// $this->load->library('upload');
		$this->form_validation->set_rules('user', 'User', 'required');
		$this->form_validation->set_rules('course', 'Course', 'required');
		$this->form_validation->set_rules('lno', 'License Number', 'required');
		$this->form_validation->set_rules('session', 'Session', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		// $this->form_validation->set_rules('file', 'Document', 'required');
           if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()."</div>");
					redirect('certificate/new_certificate/');
                }
                else
                {

					$cid=$this->certificate_model->insert_certificate($uploaded);
		  			$this->session->set_flashdata('message', "<div class='alert alert-success'>Uploaded </div>");
		  			redirect('certificate/');
                }       

	}
 	
}

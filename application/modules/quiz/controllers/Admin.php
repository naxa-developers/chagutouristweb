<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Admin_Controller {
	function __construct() {
		if(!$this->session->userdata('logged_in'))
		{
			redirect(ADMIN_LOGIN_PATH, 'refresh');exit;
		}
		$this->template->set_layout('admin/default');
		$this->load->model('Admin_dash_model');
		$this->load->dbforge();
		$this->load->model('Upload_model');
		$this->load->model('quiz_model');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	}
	public function index()
	{
		$this->data= array();
        $cat=$this->input->get('cat');
        $lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
        $this->data['data'] = $this->general->get_tbl_data_result('id,name,slug,description','quiz_category');

        $admin_type=$this->session->userdata('user_type');
        $this->data['admin']=$admin_type;
        //admin check
        $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/index',$this->data);
	}
	public function quiz_list()
	{
		$this->data= array();
        $cat=$this->input->get('cat');
        $lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
        $this->data['data'] = $this->general->get_tbl_data_result('*','quiz');

        $admin_type=$this->session->userdata('user_type');
        $this->data['admin']=$admin_type;
        //admin check
        $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/question_list',$this->data);
	}
	public function quiz_question()
	{
		$this->data=array();
		$this->data['quizcateory'] = $this->general->get_tbl_data_result('id,name,slug,description','quiz_category');
		$this->form_validation->set_rules('category_id', 'Quiz Category Name', 'trim|required');
		if ($this->form_validation->run() == TRUE){
	    	$lang=$this->session->get_userdata('Language');
	        if($lang['Language']=='en') {
	            $emerg_lang='en';
	        }else{
	            $emerg_lang='nep'; 
	        }
	        $title = $this->input->post('name');
	        $slug = strtolower (preg_replace('/[[:space:]]+/', '-', $title));
	        //echo "<pre>";print_r($this->input->post());die;
	      	$insert=$this->quiz_model->add_question('quiz');
	      	if($insert){
	        	$this->session->set_flashdata('msg','Quiz Category successfully added');
	        	redirect(FOLDER_ADMIN.'/quiz/quiz_list');
	        }
	    }else{
	      	//admin check
	    	$id = base64_decode($this->input->get('id'));
	    	//print_r($id);die;
	    	if($id) {
				$this->data['drrdataeditdata'] = $this->general->get_tbl_data_result('*','quiz',array('id'=>$id));
				//echo "<pre>";print_r($this->data['drrdataeditdata']);die;
	    	}else{
	    		$this->data['drrdataeditdata'] = array();	
	    	}
	      	$admin_type=$this->session->userdata('user_type');
	      	$this->data['admin']=$admin_type;
	      	//admin check
	      	$this->template
	                        ->enable_parser(FALSE)
	                        ->build('admin/quiz_question',$this->data);
	    }
	}
	public function add()
	{
		$this->data=array();
		$this->form_validation->set_rules('name', 'Quiz Category ', 'trim|required');
		if ($this->form_validation->run() == TRUE){
	    	$lang=$this->session->get_userdata('Language');
	        if($lang['Language']=='en') {
	            $emerg_lang='en';
	        }else{
	            $emerg_lang='nep'; 
	        }
	        $title = $this->input->post('name');
	        $slug = strtolower (preg_replace('/[[:space:]]+/', '-', $title));
	        $id=$this->input->post('id');
	        if($id)
	        {
	        	$data=array(
		        	'name'=>$title,
		        	'description'=>$this->input->post('description'),
		        	'created_at'=>$this->input->post('created_at')
		      	);
	        }else{
	        	$data=array(
		        	'name'=>$title,
		        	'slug'=>$slug,
		        	'description'=>$this->input->post('description'),
		        	'created_at'=>$this->input->post('created_at')
		      	);
	        }
	      	//print_r($this->inpu->post());die;
	      	$insert=$this->quiz_model->add_inventory('quiz_category',$data);
	      	if($insert!=""){
	        	$this->session->set_flashdata('msg','Quiz Category successfully added');
	        	redirect(FOLDER_ADMIN.'/quiz');
	        }
	    }else{
	      	//admin check
	    	$id = base64_decode($this->input->get('id'));
	    	//print_r($id);die;
	    	if($id) {
				$this->data['drrdataeditdata'] = $this->general->get_tbl_data_result('*','quiz_category',array('id'=>$id));
	    	}else{
	    		$this->data['drrdataeditdata'] = array();	
	    	}
	      	$admin_type=$this->session->userdata('user_type');
	      	$this->data['admin']=$admin_type;
	      	//admin check
	      	$this->template
	                        ->enable_parser(FALSE)
	                        ->build('admin/quiz',$this->data);
	    }
	}
	public function delete(){
	    $tbl="quiz_category";
	    $id = base64_decode($this->input->get('id'));
	    $delete=$this->quiz_model->delete($id,$tbl);
	    if($delete){
      		$this->session->set_flashdata('msg','Successfully Deleted');
	        redirect(FOLDER_ADMIN.'/quiz');
    	}
  	}
  	public function delete_lists()
  	{
  		$tbl="quiz";
	    $id = base64_decode($this->input->get('id'));
	    $delete=$this->quiz_model->delete($id,$tbl);
	    if($delete){
      		$this->session->set_flashdata('msg','Successfully Deleted');
	        redirect(FOLDER_ADMIN.'/quiz/quiz_list');
    	}
  	}
}
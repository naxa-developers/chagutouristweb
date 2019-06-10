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
		$this->load->model('calendar_mdl');
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
        $this->data['data'] = $this->general->get_tbl_data_result('id,name,slug,description','calendar',array('language'=>$emerg_lang));

        $admin_type=$this->session->userdata('user_type');
        $this->data['admin']=$admin_type;
        //admin check
        $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/index',$this->data);
	}
	public function add()
	{
		$this->data=array();
		$this->form_validation->set_rules('name', 'SEASONAL PREPAREDNESS CALENDAR Name', 'trim|required');
		$this->data['categories'] = $this->general->get_tbl_data_result('id,slug,name','drrcategory',false,'sort_order',false);
		if ($this->form_validation->run() == TRUE){
	    	$lang=$this->session->get_userdata('Language');
	        if($lang['Language']=='en') {
	            $emerg_lang='en';
	        }else{
	            $emerg_lang='nep'; 
	        }
	        $title = $this->input->post('name');
	        $slug = strtolower (preg_replace('/[[:space:]]+/', '-', $title));
	      	$data=array(
	        	'name'=>$title,
	        	'slug'=>$slug,
	        	'type'=>$this->input->post('type'),
	        	'description'=>$this->input->post('description'),
	        	'created_at'=>$this->input->post('created_at'),
	        	'language'=>$emerg_lang,
	      	);
	      	//print_r($data);die;
	      	$insert=$this->calendar_mdl	->add_inventory('calendar',$data);
	      	if($insert!=""){
	        	$this->session->set_flashdata('msg','SEASONAL PREPAREDNESS CALENDAR successfully added');
	        	redirect(FOLDER_ADMIN.'/calendar');
	        }
	    }else{
	      	//admin check
	    	$id = base64_decode($this->input->get('id'));
	    	//print_r($id);die;
	    	if($id) {
				$this->data['drrdataeditdata'] = $this->general->get_tbl_data_result('*','calendar',array('id'=>$id));
	    	}else{
	    		$this->data['drrdataeditdata'] = array();	
	    	}
	    	//echo "<pre>";print_r($this->data['drrdataeditdata']);die;
	      	$admin_type=$this->session->userdata('user_type');
	      	$this->data['admin']=$admin_type;
	      	//admin check
	      	$this->template
	                        ->enable_parser(FALSE)
	                        ->build('admin/calendar',$this->data);
	    }
	}
	public function delete(){
	    $tbl="calendar";
	    $id = base64_decode($this->input->get('id'));
	    $delete=$this->calendar_mdl	->delete($id,$tbl);
	    if($delete){
      		$this->session->set_flashdata('msg','Successfully Deleted');
	        redirect(FOLDER_ADMIN.'/calendar');
    	}
  	}
}
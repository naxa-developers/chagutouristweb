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
		$this->load->model('user_model');
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
        $this->data['data'] = $this->general->get_tbl_data_result('user_id,username,token,email,gender,purpose,contact_num,start_date,end_date,country','users',array('user_id >'=>2));
        //echo"<pre>"; print_r($this->data['data']);die;
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
		$id = base64_decode($this->input->get('id'));
		$this->data['country'] = $this->general->get_tbl_data_result('country_name','apps_countries');
		$this->form_validation->set_rules('name', 'user name', 'trim|required');
		$this->form_validation->set_rules('email', 'user email', 'trim|required');
		$this->form_validation->set_rules('country', 'Please Select Country', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Please Enter Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'Please Enter End Date', 'trim|required');
		$this->data['maxid'] = $this->general->get_tbl_data_result('"max"(user_id) as id','users');
		if($id) {
			$this->data['users'] = $this->general->get_tbl_data_result('*','users',array('user_id'=>$id));
    	}else{
    		$this->data['users'] = array();	
    	}
    	//echo "<pre>";print_r($this->data['users']);die;
		if ($this->form_validation->run() == TRUE){
	      	$data=array(
	      		'username'=>$this->input->post('name'),
	      		'token'=>!empty($id)?($this->data['users'][0]['token']):'CTG'.$this->data['maxid'][0]['id'],
				'email'=>$this->input->post('email'),
				'gender'=>$this->input->post('gender'),
				'purpose'=>$this->input->post('purpose'),
				'contact_num'=>$this->input->post('contact_num'),
				'start_date'=>$this->input->post('start_date'),
				'end_date'=>$this->input->post('end_date'),
				'country'=>$this->input->post('country')
	      	);
	      	//echo "<pre>";print_r($data);die;
	      	$insert=$this->user_model->add_user('users',$data);
	      	if($insert!=""){
	        	$this->session->set_flashdata('msg','User added Successfully !!');
	        	redirect(FOLDER_ADMIN.'/user');
	        }
	    }else{
	      	$admin_type=$this->session->userdata('user_type');
	      	$this->data['admin']=$admin_type;
	      	//admin check
	      	$this->template
	                        ->enable_parser(FALSE)
	                        ->build('admin/useradd',$this->data);
	    }
	}
	public function delete(){
	    $tbl="calendar";
	    $id = base64_decode($this->input->get('id'));
	    $delete=$this->user_model->delete($id,$tbl);
	    if($delete){
      		$this->session->set_flashdata('msg','Successfully Deleted');
	        redirect(FOLDER_ADMIN.'/calendar');
    	}
  	}
}
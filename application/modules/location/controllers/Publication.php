<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Publication extends Admin_Controller
{
	function __construct()
	{
        $this->load->model('Main_model');
        $this->load->model('Upload_model');
        $this->load->model('Report_model');
        $this->load->model('Publication_model');

        $this->template->set_layout('frontend/default');
	}

	public function index(){
			$this->body=array();


		    $this->data['pub'] = $this->general->get_tbl_data_result('id,name','drrcategory');
		    $this->data['pubcat']=$this->Publication_model->get_publication_data();
	      	//echo $this->db->last_query();die;
	      	$this->data['pubcatfiletype'] =$this->config->item('publicationFileType');
	      	//echo "<pre>";print_r($this->data['pub']);die;
		    //language
		    if(isset($_POST['submit'])){
		    	$this->data['publicationdata']=$this->Publication_model->publication_search();
		    }else{
		    	$this->data['publicationdata']=$this->Publication_model->publication_search('files');
		    	//echo $this->db->last_query();die;
		    }


		   //	echo "<pre>"; print_r($this->data['pubcatfiletype ']);die;
		    if($this->session->userdata('Language')==NULL){

		      $this->session->set_userdata('Language','nep');
		    }

		    $lang=$this->session->get_userdata('Language');


		    if($lang['Language']=='en'){
		        $this->data['pub_lang']='en';

		    }else{
		       $this->data['pub_lang']='en';


		    }
		   	$this->data['urll']=$this->uri->segment(1);
			$this->template
				->enable_parser(FALSE)
				->build('frontend/publication', $this->data);
    }

    public function details()
    {
    	$lang=$this->session->get_userdata('Language');
	    if($lang['Language']=='en') {
	      $language='en';
	    }else{
	      $language='nep';
	    }
		$this->data['publicationdata'] = $this->Publication_model->get_publication_details();
		$this->data['pubd']=$this->Publication_model->get_publication_search();
		//echo "<pre>"; print_r($this->data['pubd']);die;
		$this->template
				->enable_parser(FALSE)
				->build('frontend/publicationdetails', $this->data);
    }

	public function download(){
		$file=$this->input->get('file');
		$name=$this->input->get('title').'.pdf';
		$this->load->helper('download');
		$data=file_get_contents($file);
		force_download($name,$data);

	}
	function downloadimage()
	{
	    $this->load->helper('download');
	    $img=$this->input->get('file');
	    $name=$this->input->get('title').'.jpg';
	    //print_r($img);die;
	    force_download($img, NULL);
	}
}

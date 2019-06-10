<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends Admin_Controller
{
	function __construct()
	{
        $this->load->model('Main_model');
        $this->load->model('Upload_model');
        $this->load->model('Report_model');
        $this->load->model('home_mdl');
        $this->load->model('Publication_model');
	}
	public function index() //default_page
    {
    	$this->template->set_layout('frontend/default');
    	$this->data=array();
	    $tbl='categories_tbl';
	    $this->data['feature']=$this->general->get_tbl_data_result(('"table","title","photo","summary"'),'featured_dataset',array('lang'=>'en','default'=>'1'));
	    //views add
	    //echo "<pre>"; print_r($this->data['feature']);die;
	    $count=$this->Report_model->get_count_views('home');
	    $add_count=$count['views_count']+1;
	    $data=array(
	        'views_count'=>$add_count,
	      );
	    $this->Report_model->update_views($count['id'],$data);
	    //views add end
	    //incident type count
	    $incident_count=$this->Report_model->get_incident_count();
	    $incident_count_list=array();
		    foreach($incident_count as $c){
		      	$d=array($c['incident_type']=>$c['count']);
		      	array_push($incident_count_list,$d);
		    }
	    $incident_count_datas = call_user_func_array('array_merge', $incident_count_list);
	    ///pp($incident_count_datas);
	    $this->data['report_inci']=$incident_count_datas;
	    //incident count end
	    //language
	    if($this->session->userdata('Language')==NULL){
	      	$this->session->set_userdata('Language','nep');
	    }
	    $lang=$this->session->get_userdata('Language');
	       	if($lang['Language']=='en'){
	        	$language='en';
	      	}else{
	        	$language='nep';
	      	}
        $this->data['site_info'] = "";
        $this->data['feature']=$this->Main_model->get_feature();
        $this->data['feat_lang']='en';
        $this->data['drrdata'] = $this->general->get_tbl_data_result('id,slug,description,image,name,svgimage','drrcategory',array('language'=>$language),'sort_order',false,'5');
        $this->data['sliderhome'] = $this->general->get_tbl_data_result('image,name,description','homepageslider');
        $this->data['beready'] = $this->general->get_tbl_data_result('id,slug,name,description','beready');
         
        $this->data['hazard_data']=$this->general->get_tbl_data_result('id,category_name,category_photo,category_table,category_type,public_view,language',$tbl,array('category_type'=>'Hazard_Data','language'=>$language));
	    // Exposure_Data
	    $this->data['exposure_data']=$this->general->get_tbl_data_result('id,category_name,category_photo,category_table,category_type,public_view,language',$tbl,array('category_type'=>'Exposure_Data','language'=>$language),'id');
	    $this->data['baseline_data']=$this->general->get_tbl_data_result('id,category_name,category_photo,category_table,category_type,public_view,language',$tbl,array('category_type'=>'Baseline_Data','language'=>$language),'id');
	    $cat_tbl_list=$this->general->get_tbl_data_result('id,category_name,category_photo,category_table,category_type,public_view,language',$tbl,array('language'=>$language),'id');
	    //echo "<pre>";print_r($this->data['drrdata']);die;	
	   
	    $this->data['urll']=$this->uri->segment(1);


		$this->template
			->enable_parser(FALSE)
			//->title($this->data['page_title']) //this is for seo purpose
			->build('home', $this->data);
	}
	public function disasterdetails($slug)
	{
		$this->template->set_layout('frontend/default');
		$data= array();
		$data['beready'] = $this->general->get_tbl_data_result('id,slug,name,description,image','	',array('slug'=>$slug));
		//echo "<pre>"; print_r($this->data['beready']); die;	
	    $this->template
			->enable_parser(FALSE)
			->build('frontend/readydetails', $data);
	}
	public function knowledge()
	{
		$this->template->set_layout('frontend/default');
		$data= array();

		//echo "<pre>"; print_r($this->input->post());die;	
		$this->data['publication']=$this->Publication_model->get_publication();
	  	$this->data['pub'] = $this->general->get_tbl_data_result('id,name','drrcategory');
      	$this->data['pubcat'] = $this->general->get_tbl_data_result('id,name,slug','publicationsubcat');
      	$this->data['pubcatfiletype'] =$this->config->item('publicationFileType');
      	//echo "<pre>"; print_r($this->data['pubcat']); die;
	    $this->template
			->enable_parser(FALSE)
			->build('frontend/knownedgelist', $this->data);
	}
	public function subscribe_form()
	{
		//print_r($this->input->post('email'));die;

		if($this->input->server('REQUEST_METHOD')=='POST')
		{
			$data['email']=$this->input->post('email');
		 	$template =$this->template
			->enable_parser(FALSE)
			->build('subscribe_form',$data);
				print_r(json_encode(array('statuses'=>'success','template'=>$template)));
	        	exit;
		}else{
			print_r(json_encode(array('status'=>'error','message'=>'Cannot Perform this Operation')));
			exit;
		}

	}
	public function save_subscribe_form()
	{
		if($this->input->server('REQUEST_METHOD')=='POST')
		{
			$success  = $this->home_mdl->saveSubscribe();
			if($success)
			{
        		print_r(json_encode(array('statuses'=>'success','message'=>'Thanks For Subscribe Our ')));
        		exit;
       		}else{
        		print_r(json_encode(array('statuses'=>'error','message'=>'Operation Unsuccessfully!!')));
        		exit;
        	}
		}else{
			print_r(json_encode(array('status'=>'error','message'=>'Cannot Perform this Operation')));
			exit;
		}
	}
	public function change_language()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$lang=$this->input->post('language');
			if($lang=='nep')
			{
				$this->session->set_userdata('Language','nep');
			}
			if($lang=='en')
			{
				$this->session->set_userdata('Language','en');
			}
			print_r(json_encode(array('status'=>'success','message'=>'Language Set successfully')));
			 exit;
		}
		else{
	    	print_r(json_encode(array('status'=>'error','message'=>'Cannot Perform this Operation')));
	        exit;
	    }
	}
	public function aboutus()
	{
		$data= array();
		$data['about']=$this->general->get_tbl_data_result('*','about',array('id'=>'5'));
		//echo "<pre>";print_r($data['about']);die; 	
	 	$this->template->set_layout('frontend/default');
	    $this->template
			->enable_parser(FALSE)
			->build('frontend/about', $data);
	}
	public function nepal_info()
	{
		$data= array();
		$data['about']=$this->general->get_tbl_data_result('*','about',array('id'=>'4'));
		//echo "<pre>";print_r($data['about']);die; 	
	 	$this->template->set_layout('frontend/default');
	    $this->template
			->enable_parser(FALSE)
			->build('frontend/about', $data);
	}
	public function datacategory()
	{
		$this->data= array();
		$lang=$this->session->get_userdata('Language');
 			 if($lang['Language']=='en'){
 				 $language='en';
 			 }else{
 				 $language='nep';
 			 }
		  $this->data['datacategory']=$this->general->get_tbl_data_result('id,category_name,category_photo,category_table,category_type,public_view,summary,views,download,last_updated,language','categories_tbl',array('language'=>$language),'id');
			// var_dump($this->data['datacategory']);
			// die;

	 	$this->template->set_layout('frontend/default');
	    // $this->data= array();
	    $this->template
			->enable_parser(FALSE)
			->build('frontend/datacategory', $this->data);
	}
}


// super admin:
// username = super-admin
// password= yvbkCefQ4pMytmISKm

// admin :
// username = admin
// password= yvbkCeRtepMytmISKm
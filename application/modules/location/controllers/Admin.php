<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Admin extends Admin_Controller {
	function __construct() {
		if(!$this->session->userdata('logged_in'))
		{
			redirect(ADMIN_LOGIN_PATH, 'refresh');exit;
		}
		$this->template->set_layout('admin/default');
		$this->load->model('Admin_dash_model');
		$this->load->dbforge();
		$this->load->model('Location_model');
		$this->load->library('form_validation');
		$this->load->library('ciqrcode');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
	}
	public function tets()
	{
		$nim = "barun-prakash";
		$config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './uploads/location/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$nim.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $nim; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = './uploads/location/qrcode/'.$image_name; 
        //$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $ttt = $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $qrcode = base_url() . 'uploads/location/qrcode/'.$image_name;
        print_r($qrcode);die;
	}
	public function view_location(){
	  	$this->data= array();
	  	$lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
	   // $this->data['data']=$this->Location_model->get_all_data();
	    $this->data['data'] = $this->general->get_tbl_data_result('id,description,created_at,image,language,audio,video,sort_order,rating,longitude,latitude,qrcode','locationinformation',array('language'=>$emerg_lang));
	    $admin_type=$this->session->userdata('user_type');
	    $this->data['admin']=$admin_type;
	    //admin check
	    $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/publication_tbl',$this->data);

  	}
  	public function filecat()
  	{
  		$this->data=array();
	 	$this->form_validation->set_rules('name', 'Publication File Category Name', 'trim|required');
	 	$lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
      	$data['pub'] = $this->general->get_tbl_data_result('id,name','publicationsubcat');
      
      	//echo "<pre>"; print_r($this->data['pub']);die;
		if ($this->form_validation->run() == TRUE){
	      	$page_slug_new = strtolower (preg_replace('/[[:space:]]+/', '-', $this->input->post('name')));
	      	$data=array(
	        	'name'=>$this->input->post('name'),
	        	'sub_cat_id'=>$this->input->post('category'),
	        	'slug'=>$page_slug_new,
	      	);
	      	$insert=$this->Location_model->add_publiactioncat('publicationfilecat',$data);
	      	if($insert!=""){
		        $this->session->set_flashdata('msg','Publication successfully added');
		        redirect(FOLDER_ADMIN.'/publication/filecat');
	        }
	    }else{
	      //admin check
	    	$id = base64_decode($this->input->get('id'));
	    	if($id) {
				$data['puddata'] = $this->general->get_tbl_data_result('sub_cat_id,id,name','publicationfilecat',array('id'=>$id));
	    	}else{
	    		$data['puddata'] = array();	
	    	}
	    	//print_r($data['puddata']);die;
	    	$data['publicationdata'] =$this->Location_model->get_publication_filecat();	
	      	$admin_type=$this->session->userdata('user_type');
	      	$data['admin']=$admin_type;
	      	//admin check
	      	$this->template
	                        ->enable_parser(FALSE)
	                        ->build('admin/file_cat',$data);
	    }
  		
  	}
  	public function delete_filecat(){
	    $id = $this->input->get('id');
	    $delete=$this->Location_model->delete_data($id, 'publicationfilecat');

	    $this->session->set_flashdata('msg','Id number '.$id.' row data was deleted successfully');
	    // redirect('view_publication');
	    redirect(FOLDER_ADMIN.'/publication/filecat');
  	}
  	public function add_publication_sub_category(){
	 	$this->data=array();
	 	$this->form_validation->set_rules('name', 'Language  Name', 'trim|required');
	 	$this->form_validation->set_rules('alias', 'Language Represents', 'trim|required');
		if ($this->form_validation->run() == TRUE){
	      	$page_slug_new = strtolower (preg_replace('/[[:space:]]+/', '-', $this->input->post('name')));
	      	$data=array(
	        	'name'=>$this->input->post('name'),
	        	'alias'=>$this->input->post('alias'),
	        	'slug'=>$page_slug_new,
	      	);
	      	$insert=$this->Location_model->add_publiactioncat('publicationsubcat',$data);
	      	if($insert!=""){
		        $this->session->set_flashdata('msg','Publication successfully added');
		        redirect(FOLDER_ADMIN.'/publication/add_publication_sub_category');
	        }
	    }else{
	      //admin check
	    	$id = base64_decode($this->input->get('id'));
	    	//print_r($id);die;
	    	if($id) {
				$this->data['drrdataeditdata'] = $this->general->get_tbl_data_result('id,name,alias','publicationsubcat',array('id'=>$id));
	    	}else{
	    		$this->data['drrdataeditdata'] = array();	
	    	}
	    	$this->data['publicationdata'] = $this->general->get_tbl_data_result('id,name,alias','publicationsubcat');	
	      	$admin_type=$this->session->userdata('user_type');
	      	$this->data['admin']=$admin_type;
	      	//admin check
	      	$this->template
	                        ->enable_parser(FALSE)
	                        ->build('admin/index_subcat',$this->data);
	    }
	}
  	public function add_location_category(){
	 	$this->data=array();
	 	$this->form_validation->set_rules('name', 'Location Category Name', 'trim|required');
	 	$lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
		if ($this->form_validation->run() == TRUE){
	      	$page_slug_new = strtolower (preg_replace('/[[:space:]]+/', '-', $this->input->post('name')));
	      	$data=array(
	        	'name'=>$this->input->post('name'),
	        	'language'=>$emerg_lang,
	        	'slug'=>$page_slug_new,
	      	);
	      	$insert=$this->Location_model->add_publiactioncat('locationcategory',$data);
	      	if($insert!=""){
		        $this->session->set_flashdata('msg','Location successfully added');
		        redirect(FOLDER_ADMIN.'/location/add_location_category');
	        }
	    }else{
	      //admin check
	    	$id = base64_decode($this->input->get('id'));
	    	
	    	if($id) {
				$this->data['drrdataeditdata'] = $this->general->get_tbl_data_result('id,name','locationcategory',array('id'=>$id));
	    	}else{
	    		$this->data['drrdataeditdata'] = array();	
	    	}
	    	$this->data['publicationdata'] = $this->general->get_tbl_data_result('id,name','locationcategory',array('language'=>$emerg_lang));
	    	//echo "<pre>";print_r($this->data['publicationdata']);die;	
	      	$admin_type=$this->session->userdata('user_type');
	      	$this->data['admin']=$admin_type;
	      	//admin check
	      	$this->template
	                        ->enable_parser(FALSE)
	                        ->build('admin/index',$this->data);
	    }
	}
 	public function add_location(){
 		$this->data=array();
    	$this->form_validation->set_rules('title', 'Please Enter Title ', 'trim|required');
    	// $this->form_validation->set_rules('type', 'Please select Type ', 'trim|required');
    	$lang=$this->session->get_userdata('Language');
	    $language=$lang['Language'];
		if ($this->form_validation->run() == TRUE){
	      	$file_name = $_FILES['proj_pic']['name'];
	      	$audio=$_FILES['audio']['name'];
	      	$video=$_FILES['video']['name'];
	      	//echo "<pre>"; print_r($this->input->post());die;
	    	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	      	$ext_file_audio = pathinfo($audio, PATHINFO_EXTENSION);
	      	$ext_file_video = pathinfo($video, PATHINFO_EXTENSION);
	      	$page_slug_new = strtolower (preg_replace('/[[:space:]]+/', '-', $this->input->post('title')));
	      	if($this->input->post('category') == "other"){
	      		$cat = "1000";
	      	}else{
	      		$cat =$this->input->post('category');
	      	}
	      	$data=array(
	        	'title'=>$this->input->post('title'),
	        	'slug'=>$page_slug_new,
	        	'description'=>$this->input->post('summary'),
	        	'type_id'=>$this->input->post('type'),
	        	'longitude'=>$this->input->post('longitude'),
	        	'latitude'=>$this->input->post('latitude'),
	        	'sort_order'=>$this->input->post('sort_order'),
	        	'language'=>$language,
	      	);
	      	$insert=$this->Location_model->add_publication('locationinformation',$data);
	      	//print_r($insert);die;
	      	// qr code generate start from here
				$config['cacheable']    = true; //boolean, the default is true
		        $config['cachedir']     = './assets/'; //string, the default is application/cache/
		        $config['errorlog']     = './assets/'; //string, the default is application/logs/
		        //$config['imagedir']     = './uploads/location/qrcode/'; //direktori penyimpanan qr code
		        $config['quality']      = true; //boolean, the default is true
		        $config['size']         = '1024'; //interger, the default is 1024
		        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
		        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
		        $this->ciqrcode->initialize($config);
		 
		        $image_name_qr=$insert.'.png'; //buat name dari qr code sesuai dengan nim
		 
		        $params['data'] = $insert; //data yang akan di jadikan QR CODE
		        $params['level'] = 'H'; //H=High
		        $params['size'] = 10;
		        $params['savename'] = './uploads/location/qrcode/'.$image_name_qr;  //simpan image QR CODE ke folder assets/images/
		        $this->ciqrcode->generate($params);
		        $qrcode = base_url() . 'uploads/location/qrcode/'.$image_name_qr;

	      	// qr code end
	      	if($insert!=""){
	      		if(!empty($video)){
	      			$file_upload_video=$this->Location_model->file_do_uploa_video($video,$insert);

	      		}else{
	      			$file_upload_video='';
	      		}
	      		if(!empty($audio)){
	      			$file_upload_audio=$this->Location_model->file_do_uploa_audiod($audio,$insert);

	      		}else{
	      			$file_upload_audio='';
	      		}
	      		if(!empty($file_name)){
	      			$img_upload=$this->Location_model->do_upload($file_name,$insert);
	      		}else{
	      			$img_upload['status']='';
	      		}
	      		//echo "<pre>"; print_r($file_upload_video);die;
		        if($img_upload['status']== 1  || $file_upload_audio || $file_upload_video){
		            if($img_upload['status']== 1){
		          		$image_path=base_url() . 'uploads/publication/'.$insert.'.'.$ext;
		          		//print_r($image_path);die;
		            }else{
		          		$image_path='';
		          	}
		          	if($file_upload_audio == 1) {
		          		$file_path_audiofinal=base_url() . 'uploads/publication/file/'.$insert.'.'.$ext_file_audio;//base_url().$file_upload_audio;
		          	}else{
		          		$file_path_audiofinal='';
		          	}
		          	if($file_upload_audio == 1) {
		          		$file_path_videofinal=base_url() . 'uploads/publication/file/'.$insert.'.'.$ext_file_video;//base_url().$file_upload_audio;
		          	}else{
		          		$file_path_videofinal='';
		          	}
		          	$img=array(
			            'image'=>$image_path,//
			            'audio'=>$file_path_audiofinal,
			            'video'=>$file_path_videofinal,
			            'qrcode'=>$qrcode,
			        );
			       	//echo"<pre>"; print_r($img);die;
		            $update_path=$this->Location_model->update_path($insert,$img);
		            $this->session->set_flashdata('msg','Publication successfully added');
		          	redirect(FOLDER_ADMIN.'/location/view_location');
		        }elseif($this->input->post('videolink')) {
		        	redirect(FOLDER_ADMIN.'/location/view_location');
		        }else{
		            $code= strip_tags($img_upload['error']);
		            $this->session->set_flashdata('msg', $code);
		            redirect(FOLDER_ADMIN.'/location/add_location');
		        }
	        }
	    }else{
	        //admin check
	        $admin_type=$this->session->userdata('user_type');
	        $this->data['admin']=$admin_type;
	        //admin check
	     	$this->data['destination']=$this->general->get_tbl_data_result('*','destination',array('language'=>$language),'id');
	     	$this->data['pub']=$this->general->get_tbl_data_result('*','locationcategory',array('language'=>$language),'id');
		    //echo "<pre>"; print_r($this->body['pub']);die;
		    $this->template
	                        ->enable_parser(FALSE)
	                        ->build('admin/add_location',$this->data);
	    }
    }
    public function edit_publication(){
	    $this->data=array();
	    $lang=$this->session->get_userdata('Language');
	    $language=$lang['Language'];
	    $id=base64_decode($this->input->get('id'));
	    $this->data['pub']=$this->general->get_tbl_data_result('*','locationinformation',array('language'=>$language),'id');
	    if(isset($_POST['submit'])){
	    	//echo "<pre>"; print_r($this->input->post());die;
	    	$old_old_videofile  = $this->input->post('old_video');
	      	$old_audio  = $this->input->post('old_audio');
	      	$old_image  = $this->input->post('old_image');
	      	if(!empty($_FILES['proj_pic']['name']) || !empty($_FILES['audio']['name']) || !empty($_FILES['video']['name'])){
		            $file_name = !empty($_FILES['proj_pic']['name'])?$_FILES['proj_pic']['name']:'';
			      	$attachment=	!empty($_FILES['uploadedfile']['name'])?$_FILES['uploadedfile']['name']:'';
			      	$audio=$_FILES['audio']['name'];
			      	//echo "<pre>"; print_r($audio);die;
			      	$page_slug_new = strtolower (preg_replace('/[[:space:]]+/', '-', $this->input->post('title')));
			      	$video=$_FILES['video']['name'];
					$ext_file_video = pathinfo($video, PATHINFO_EXTENSION);
			    	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			      	$ext_file = pathinfo($attachment, PATHINFO_EXTENSION);
			      	$ext_file_audio = pathinfo($audio, PATHINFO_EXTENSION);
			      	$old_uploadedfile  = $this->input->post('old_uploadedfile');
			      	$old_old_videofile  = $this->input->post('old_video');
			      	$old_audio  = $this->input->post('old_audio');
			      	$old_image  = $this->input->post('old_image');
			      	$data=array(
			        	'title'=>$this->input->post('title'),
			        	'slug'=>$page_slug_new,
			        	'description'=>$this->input->post('summary'),
			        	'type_id'=>$this->input->post('type'),
			        	'longitude'=>$this->input->post('longitude'),
			        	'latitude'=>$this->input->post('latitude'),
			        	'sort_order'=>$this->input->post('sort_order'),
			        	'language'=>$language,
			      	);
		        	$insert=$this->Location_model->update_data($id,$data);
			        if($insert==1){
			        	if(!empty($video)){
			      			$file_upload_video=$this->Location_model->file_do_uploa_video($video,$insert);
			      			//print_r($file_upload_video);die;
			      		}else{
			      			$file_upload_video='';
			      		}
			        	if(!empty($audio)){
		      				$file_upload_audio=$this->Location_model->file_do_uploa_audiod($audio,$id);
			      		}else{
			      			$file_upload_audio='';
			      		}
			      		if(!empty($file_name)){
			      			$img_upload=$this->Location_model->do_upload($file_name,$id);
			      		}else{
			      			$img_upload['status']='';
			      		}
			      		if(!empty($attachment)){
			      			$file_upload=$this->Location_model->file_do_upload($attachment,$id);
			      		}else{
			      			$file_upload['status']='';
			      		}
				        if($img_upload['status']== 1 || $file_upload['status']== 1  || $file_upload_audio || $file_upload_video){
				            if($img_upload['status']== 1){
				            	unlink($old_image);
				          		$image_path=base_url() . 'uploads/publication/'.$id.'.'.$ext;
				            }else{
				          		$image_path=$old_image;
				          	}
				          	if($file_upload_video == 1) {
				          		$file_path_videofinal=base_url() . 'uploads/publication/file/'.$insert.'.'.$ext_file_video;//base_url().$file_upload_audio;
				          	}else{
				          		$file_path_videofinal=$old_old_videofile;
				          	}
				          	if($file_upload_audio == 1) {
				          		$file_path_audiofinal=base_url() . 'uploads/publication/file/'.$insert.'.'.$ext_file_audio;//base_url().$file_upload_audio;
				          	}else{
				          		$file_path_audiofinal=$ext_file_audio;
				          	}
				          	//print_r($image_path); die;
				          	if($file_upload== 1) {
				          		unlink($old_uploadedfile);
				          		$file_pathd=base_url() . 'uploads/publication/file/'.$id.'.'.$ext_file;
				          	}else{
				          		$file_pathd='';
				          	}
				          	// if($file_upload_audio) {
				          	// 	unlink($old_audio);
				          	// 	$file_path_audiofinal=base_url().$file_upload_audio;
				          	// }else{
				          	// 	$file_path_audiofinal=$old_audio;
				          	// }
				        $img=array(
				            'image'=>$image_path,
				            //'file'=>$file_pathd,
				            'audio'=>$file_path_audiofinal,
				            'video'=>$file_path_videofinal,
				        ); 	
				        //echo "<pre>"; print_r($img);die;
			            $update_path=$this->Location_model->update_path($id,$img);
			            $this->session->set_flashdata('msg','Location successfully Updated');
			            // redirect('view_publication');
			            redirect(FOLDER_ADMIN.'/location/view_location');
			          }else{
			            $code= strip_tags($img_upload['error']);
			            $this->session->set_flashdata('msg', $code);
			            // redirect('add_publication');
		          		redirect(FOLDER_ADMIN.'/location/add_publication');

			          }
			        }else{
			          //db error
			        }
	        }else{
		        $data=array(
			        	'title'=>$this->input->post('title'),
			        	'description'=>$this->input->post('summary'),
			        	'type_id'=>$this->input->post('type'),
			        	'longitude'=>$this->input->post('longitude'),
			        	'latitude'=>$this->input->post('latitude'),
			        	'sort_order'=>$this->input->post('sort_order'),
			        	'language'=>$language,
			      	);
		        //echo "<pre>";print_r($data);die;
		        $update=$this->Location_model->update_data($id,$data);
		        if($update==1){
		          $this->session->set_flashdata('msg','Data successfully Updated');
		          // redirect('view_publication');
		          redirect(FOLDER_ADMIN.'/location/view_location');
		        }	    
		     }
	    }else{

	      $this->data['edit_data']=$this->Location_model->get_edit_data($id,'locationinformation');
	      //echo "<pre>"; print_r($this->data['edit_data']);die;
	      $admin_type=$this->session->userdata('user_type');
	      $this->data['admin']=$admin_type;
	      //admin check
	      $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/edit_publication',$this->data);
	    }
    }
    public function delete_publication(){
	    $id = $this->input->get('id');
	    $delete=$this->Location_model->delete_data($id, 'locationinformation');

	    $this->session->set_flashdata('msg','Id number '.$id.' row data was deleted successfully');
	    // redirect('view_publication');
	    redirect(FOLDER_ADMIN.'/location/view_location');
  	}
  	
  	public function delete_publication_sub_category(){
	    $id = $this->input->get('id');
	    $delete=$this->Location_model->delete_data($id,'publicationsubcat');
	    $this->session->set_flashdata('msg','Id number '.$id.' row data was deleted successfully');
	    redirect(FOLDER_ADMIN.'/publication/add_publication_sub_category');
  	}
}

// <IfModule mod_rewrite.c>
// Options -Indexes

// RewriteEngine On
// RewriteBase /
// #RewriteCond %{REQUEST_URI} ^system.*
// #RewriteRule ^(.*)$ /index.php/$1 [L]

// RewriteCond %{REQUEST_FILENAME} !-f
// RewriteCond %{REQUEST_FILENAME} !-d
// RewriteCond $1 !^(index\.php|images|robots\.txt)
// RewriteRule ^(.*)$ /ci-video/index.php?/$1 [L]
// </IfModule> 
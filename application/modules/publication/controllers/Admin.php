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
		$this->load->model('Publication_model');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
	}
	public function view_publication(){
	  	$this->data= array();
	  	$lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
	   // $this->data['data']=$this->Publication_model->get_all_data();
	    $this->data['data'] = $this->general->get_tbl_data_result('title,summary,photo,videolink,audio as video,id','publication',array('lang'=>$emerg_lang));
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
	      	$insert=$this->Publication_model->add_publiactioncat('publicationfilecat',$data);
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
	    	$data['publicationdata'] =$this->Publication_model->get_publication_filecat();	
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
	    $delete=$this->Publication_model->delete_data($id, 'publicationfilecat');

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
	      	$insert=$this->Publication_model->add_publiactioncat('publicationsubcat',$data);
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
  	public function add_publication_category(){
	 	$this->data=array();
	 	$this->form_validation->set_rules('name', 'Publication Category Name', 'trim|required');
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
	      	$insert=$this->Publication_model->add_publiactioncat('publicationcat',$data);
	      	if($insert!=""){
		        $this->session->set_flashdata('msg','Publication successfully added');
		        redirect(FOLDER_ADMIN.'/publication/add_publication_category');
	        }
	    }else{
	      //admin check
	    	$id = base64_decode($this->input->get('id'));
	    	
	    	if($id) {
				$this->data['drrdataeditdata'] = $this->general->get_tbl_data_result('id,name','publicationcat',array('id'=>$id));
	    	}else{
	    		$this->data['drrdataeditdata'] = array();	
	    	}
	    	$this->data['publicationdata'] = $this->general->get_tbl_data_result('id,name','publicationcat',array('language'=>$emerg_lang));
	    	//echo "<pre>";print_r($this->data['publicationdata']);die;	
	      	$admin_type=$this->session->userdata('user_type');
	      	$this->data['admin']=$admin_type;
	      	//admin check
	      	$this->template
	                        ->enable_parser(FALSE)
	                        ->build('admin/index',$this->data);
	    }
	}
			public function add_map_sub_category(){
			 	$this->data=array();
			 	$this->form_validation->set_rules('name', 'Map Category Name', 'trim|required');
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
			      	$insert=$this->Publication_model->add_publiactioncat('place_category',$data);
			      	if($insert!=""){
				        $this->session->set_flashdata('msg','Map successfully added');
				        redirect(FOLDER_ADMIN.'/publication/add_map_sub_category');
			        }
			    }else{
			      //admin check
			    	$id = base64_decode($this->input->get('id'));
			    	
			    	if($id) {
						$this->data['drrdataeditdata'] = $this->general->get_tbl_data_result('id,name','place_category',array('id'=>$id));
			    	}else{
			    		$this->data['drrdataeditdata'] = array();	
			    	}
			    	$this->data['publicationdata'] = $this->general->get_tbl_data_result('id,name','place_category',array('language'=>$emerg_lang));
			    	//echo "<pre>";print_r($this->data['publicationdata']);die;	
			      	$admin_type=$this->session->userdata('user_type');
			      	$this->data['admin']=$admin_type;
			      	//admin check
			      	$this->template
			                        ->enable_parser(FALSE)
			                        ->build('admin/mapcategory',$this->data);
			    }
			}
			public function deleteMapcategory(){
			    $id = $this->input->get('id');
			    $delete=$this->Publication_model->delete_data($id, 'place_category');

			    $this->session->set_flashdata('msg','Id number '.$id.' row data was deleted successfully');
			    // redirect('view_publication');
			    redirect(FOLDER_ADMIN.'/publication/add_map_sub_category');
		  	}
		  	public function touristInformation(){
			 	$this->data=array();
			 	$lang=$this->session->get_userdata('Language');
		        $emerg_lang=$lang['Language'];
			 	$this->data['mapcategorry'] = $this->general->get_tbl_data_result('id,title as name,slug','locationinformation',array('language'=>$emerg_lang));
			 	$this->form_validation->set_rules('name', 'TOURIST INFRMATION NAME', 'trim|required');
				if ($this->form_validation->run() == TRUE){
					//echo "<pre>";print_r($this->input->post());die;	
			      	//$page_slug_new = strtolower (preg_replace('/[[:space:]]+/', '-', $this->input->post('name')));
			      	$data=array(
			        	'title'=>$this->input->post('name'),
			        	'description'=>$this->input->post('description'),
			        	'language'=>$emerg_lang,
			        	//'slug'=>$page_slug_new,
			      	);

			      	$insert=$this->Publication_model->add_publiactioncat('touristinformation',$data);
			      	if($insert!=""){
				        $this->session->set_flashdata('msg','Map successfully added');
				        redirect(FOLDER_ADMIN.'/publication/touristinformation');
			        }
			    }else{
			      //admin check
			    	$id = base64_decode($this->input->get('id'));
			    	if($id) {
						$this->data['drrdataeditdata'] = $this->general->get_tbl_data_result('id,name','touristinformation',array('id'=>$id));
			    	}else{
			    		$this->data['drrdataeditdata'] = array();	
			    	}
			    	$this->data['publicationdata'] = $this->general->get_tbl_data_result('id,name','touristinformation',array('language'=>$emerg_lang));
			    	//echo "<pre>";print_r($this->data['publicationdata']);die;	
			      	$admin_type=$this->session->userdata('user_type');
			      	$this->data['admin']=$admin_type;
			      	//admin check
			      	$this->template
			                        ->enable_parser(FALSE)
			                        ->build('admin/touristInformation',$this->data);
			    }
			}
			public function deletetouristInformation(){
			    $id = $this->input->get('id');
			    $delete=$this->Publication_model->delete_data($id, 'touristinformation');

			    $this->session->set_flashdata('msg','Id number '.$id.' row data was deleted successfully');
			    // redirect('view_publication');
			    redirect(FOLDER_ADMIN.'/publication/touristInformation');
		  	}
 	public function add_publication(){
 		$this->data=array();
    	$this->form_validation->set_rules('category', 'Please Select About ', 'trim|required');
    	$this->form_validation->set_rules('title', 'Please Fill title ', 'trim|required');
    	$lang=$this->session->get_userdata('Language');
	    if($lang['Language']=='en'){
	        $language='en';
	    }else{
	        $language='nep';
	    }
		if ($this->form_validation->run() == TRUE){
	      	$file_name = $_FILES['proj_pic']['name'];
	      	$audio=$_FILES['audio']['name'];
	      	//echo "<pre>"; print_r($file_name);die;
	    	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	      	$ext_file_audio = pathinfo($audio, PATHINFO_EXTENSION);
	      	$page_slug_new = strtolower (preg_replace('/[[:space:]]+/', '-', $this->input->post('title')));
	      	if($this->input->post('category') == "other"){
	      		$cat = "1000";
	      	}else{
	      		$cat =$this->input->post('category');
	      	}
	      	$data=array(
	        	'title'=>$this->input->post('title'),
	        	'summary'=>$this->input->post('summary'),
	        	'type'=>$this->input->post('type'),
	        	'subcat'=>$this->input->post('subcat'),
	        	'category'=>$cat,
	        	'videolink'=>$this->input->post('videolink'),
	        	'filecat'=>$this->input->post('filecat'),
	        	'lang'=>$language,
	      	);
	      	$insert=$this->Publication_model->add_publication('publication',$data);
	      	if($insert!=""){
	      		if(!empty($audio)){
	      			$file_upload_audio=$this->Publication_model->file_do_uploa_audiod($audio,$insert);

	      		}else{
	      			$file_upload_audio='';
	      		}
	      		if(!empty($file_name)){
	      			$img_upload=$this->Publication_model->do_upload($file_name,$insert);
	      		}else{
	      			$img_upload['status']='';
	      		}
	      		//echo "<pre>"; print_r($img_upload['status']);die;
		        if($img_upload['status']== 1  || $file_upload_audio || $file_upload){
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
		          	$img=array(
			            'photo'=>$image_path,//
			            'audio'=>$file_path_audiofinal,
			        );
			        //echo "<pre>"; print_r($img);die;
		            $update_path=$this->Publication_model->update_path($insert,$img);
		            $this->session->set_flashdata('msg','Publication successfully added');
		          	redirect(FOLDER_ADMIN.'/publication/view_publication');
		        }elseif($this->input->post('videolink')) {
		        	redirect(FOLDER_ADMIN.'/publication/view_publication');
		        }else{
		            $code= strip_tags($img_upload['error']);
		            $this->session->set_flashdata('msg', $code);
		            redirect(FOLDER_ADMIN.'/publication/add_publication');
		        }
	        }
	    }else{
	        //admin check
	        $admin_type=$this->session->userdata('user_type');
	        $this->data['admin']=$admin_type;
	        //admin check
	     	$this->data['pub']=$this->general->get_tbl_data_result('*','publicationcat',array('language'=>$language),'id');
		    //echo "<pre>"; print_r($this->body['pub']);die;
		    $this->template
	                        ->enable_parser(FALSE)
	                        ->build('admin/add_publication',$this->data);
	    }
    }
    public function edit_publication(){
	    $this->data=array();
	    $lang=$this->session->get_userdata('Language');
	    if($lang['Language']=='en'){
	        $language='en';
	    }else{
	        $language='nep';
	    }
	    $id=base64_decode($this->input->get('id'));
	    $this->data['pub']=$this->general->get_tbl_data_result('*','publicationcat',array('language'=>$language),'id');
	    if(isset($_POST['submit'])){
	    	//echo "<pre>"; print_r($this->input->post());die;
	      	if(!empty($_FILES['proj_pic']['name']) || !empty($_FILES['uploadedfile']['name']) || !empty($_FILES['proj_pic']['name'])){
	      		//echo "inside";die;
		            $file_name = !empty($_FILES['proj_pic']['name'])?$_FILES['proj_pic']['name']:'';
			      	$attachment=	!empty($_FILES['uploadedfile']['name'])?$_FILES['uploadedfile']['name']:'';
			      	$audio=!empty($_FILES['audio']['name'])?$_FILES['audio']['name']:'';
			      	//echo "<pre>"; print_r($audio);die;
			      	$page_slug_new = strtolower (preg_replace('/[[:space:]]+/', '-', $this->input->post('title')));

			    	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			      	$ext_file = pathinfo($attachment, PATHINFO_EXTENSION);
			      	$ext_file_audio = pathinfo($audio, PATHINFO_EXTENSION);
			      	$old_uploadedfile  = $this->input->post('old_uploadedfile');
			      	$old_audio  = $this->input->post('old_audio');
			      	$old_image  = $this->input->post('old_image');
			      		if($this->input->post('category') == "other"){
				      		$cat = "1000";
				      	}else{
				      		$cat =$this->input->post('category');
				      	}
			        $data=array(
			        	//'slug'=>$page_slug_new,
			        	'title'=>$this->input->post('title'),
			        	'summary'=>$this->input->post('summary'),
			        	'type'=>$this->input->post('type'),
			        	'subcat'=>$this->input->post('subcat'),
			        	'category'=>$cat,
			        	'videolink'=>$this->input->post('videolink'),
			        	'filecat'=>$this->input->post('filecat'),
			        	'lang'=>$language,
			      	);
		        	$insert=$this->Publication_model->update_data($id,$data);
			        if($insert==1){
			        	if(!empty($audio)){
		      			$file_upload_audio=$this->Publication_model->file_do_uploa_audiod($audio,$id);
			      		}else{
			      			$file_upload_audio='';
			      		}
			      		if(!empty($file_name)){
			      			$img_upload=$this->Publication_model->do_upload($file_name,$id);
			      		}else{
			      			$img_upload['status']='';
			      		}
			      		if(!empty($attachment)){
			      			$file_upload=$this->Publication_model->file_do_upload($attachment,$id);
			      		}else{
			      			$file_upload['status']='';
			      		}
				        if($img_upload['status']== 1 || $file_upload['status']== 1  || $file_upload_audio || $file_upload){
				            if($img_upload['status']== 1){
				            	unlink($old_image);
				          		$image_path=base_url() . 'uploads/publication/'.$id.'.'.$ext;
				            }else{
				          		$image_path='';
				          	}
				          	//print_r($image_path); die;
				          	if($file_upload== 1) {
				          		unlink($old_uploadedfile);
				          		$file_pathd=base_url() . 'uploads/publication/file/'.$id.'.'.$ext_file;
				          	}else{
				          		$file_pathd='';
				          	}
				          	if($file_upload_audio) {
				          		unlink($old_audio);
				          		$file_path_audiofinal=base_url().$file_upload_audio;
				          	}else{
				          		$file_path_audiofinal='';
				          	}
				        $img=array(
				            'photo'=>$image_path,
				            'file'=>$file_pathd,
				            'audio'=>$file_path_audiofinal,
				        ); 	
				         	// 	$img_upload=$this->Publication_model->do_upload($file_name,$id);
					        // 	if($img_upload==1){
					        //   $image_path=base_url() . 'uploads/publication/'.$id.'.'.$ext ;
					        //   $img=array(
					        //     'photo'=>$image_path,
					        //   );
				        //echo "<pre>"; print_r($img);die;
			            $update_path=$this->Publication_model->update_path($id,$img);
			            $this->session->set_flashdata('msg','Publication successfully Updated');
			            // redirect('view_publication');
			            redirect(FOLDER_ADMIN.'/publication/view_publication');
			          }else{
			            $code= strip_tags($img_upload['error']);
			            $this->session->set_flashdata('msg', $code);
			            // redirect('add_publication');
		          		redirect(FOLDER_ADMIN.'/publication/add_publication');

			          }
			        }else{
			          //db error
			        }
	        }else{
	        	if($this->input->post('category') == "other"){
		      		$cat = "1000";
		      	}else{
		      		$cat =$this->input->post('category');
		      	}
				$data=array(
		        	'title'=>$this->input->post('title'),
		        	'summary'=>$this->input->post('summary'),
		        	'type'=>$this->input->post('type'),
		        	'subcat'=>$this->input->post('subcat'),
		        	'category'=>$cat,
		        	'videolink'=>$this->input->post('videolink'),
		        	'filecat'=>$this->input->post('filecat'),
		        	'lang'=>$language
		      	);
		        $update=$this->Publication_model->update_data($id,$data);
		        if($update==1){
		          $this->session->set_flashdata('msg','Data successfully Updated');
		          // redirect('view_publication');
		          redirect(FOLDER_ADMIN.'/publication/view_publication');
		        }	    
	      }
	    }else{

	      $this->data['edit_data']=$this->Publication_model->get_edit_data(base64_decode($this->input->get('id')),'publication');
	      //admin check
	      // echo "<pre>"; print_r($this->data['edit_data']);die;
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
	    $delete=$this->Publication_model->delete_data($id, 'publication');

	    $this->session->set_flashdata('msg','Id number '.$id.' row data was deleted successfully');
	    // redirect('view_publication');
	    redirect(FOLDER_ADMIN.'/publication/view_publication');
  	}
  	
  	public function delete_publication_sub_category(){
	    $id = $this->input->get('id');
	    $delete=$this->Publication_model->delete_data($id,'publicationsubcat');
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
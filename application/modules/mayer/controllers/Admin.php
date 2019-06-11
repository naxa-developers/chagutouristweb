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
		$this->load->model('Mayer_model');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
	}
	public function view_mayer_message(){
	  	$this->data= array();
	  	$lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
	   // $this->data['data']=$this->Mayer_model->get_all_data();
	    $this->data['data'] = $this->general->get_tbl_data_result('title,video,photo,summary,id','mayermessage',array('language'=>$emerg_lang));
	    $admin_type=$this->session->userdata('user_type');
	    $this->data['admin']=$admin_type;
	    //admin check
	    $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/publication_tbl',$this->data);

  	}
 	public function add_mayer_message(){
 		$this->data=array();
    	//$this->form_validation->set_rules('category', 'Please Select About ', 'trim|required');
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
	        	'language'=>$language,
	      	);
	      	//echo "<pre>";print_r($data);die;
	      	$insert=$this->Mayer_model->add_publication('mayermessage',$data);
	      	if($insert!=""){
	      		if(!empty($audio)){
	      			$file_upload_audio=$this->Mayer_model->file_do_uploa_audiod($audio,$insert);

	      		}else{
	      			$file_upload_audio='';
	      		}
	      		if(!empty($file_name)){
	      			$img_upload=$this->Mayer_model->do_upload($file_name,$insert);
	      		}else{
	      			$img_upload['status']='';
	      		}
	      		//echo "<pre>"; print_r($img_upload['status']);die;
		        if($img_upload['status']== 1  || $file_upload_audio || $file_upload){
		            if($img_upload['status']== 1){
		          		$image_path=base_url() . 'uploads/mayer/'.$insert.'.'.$ext;
		          		//print_r($image_path);die;
		            }else{
		          		$image_path='';
		          	}
		          	if($file_upload_audio == 1) {
		          		$file_path_audiofinal=base_url() . 'uploads/mayer/file/'.$insert.'.'.$ext_file_audio;//base_url().$file_upload_audio;
		          	}else{
		          		$file_path_audiofinal='';
		          	}
		          	$img=array(
			            'photo'=>$image_path,//
			            'video'=>$file_path_audiofinal,
			        );
			        //echo "<pre>"; print_r($img);die;
		            $update_path=$this->Mayer_model->update_path($insert,$img);
		            $this->session->set_flashdata('msg','Publication successfully added');
		          	redirect(FOLDER_ADMIN.'/mayer/view_mayer_message');
		        }elseif($this->input->post('videolink')) {
		        	redirect(FOLDER_ADMIN.'/mayer/view_mayer_message');
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
		        	$insert=$this->Mayer_model->update_data($id,$data);
			        if($insert==1){
			        	if(!empty($audio)){
		      			$file_upload_audio=$this->Mayer_model->file_do_uploa_audiod($audio,$id);
			      		}else{
			      			$file_upload_audio='';
			      		}
			      		if(!empty($file_name)){
			      			$img_upload=$this->Mayer_model->do_upload($file_name,$id);
			      		}else{
			      			$img_upload['status']='';
			      		}
			      		if(!empty($attachment)){
			      			$file_upload=$this->Mayer_model->file_do_upload($attachment,$id);
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
				         	// 	$img_upload=$this->Mayer_model->do_upload($file_name,$id);
					        // 	if($img_upload==1){
					        //   $image_path=base_url() . 'uploads/publication/'.$id.'.'.$ext ;
					        //   $img=array(
					        //     'photo'=>$image_path,
					        //   );
				        //echo "<pre>"; print_r($img);die;
			            $update_path=$this->Mayer_model->update_path($id,$img);
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
		        $update=$this->Mayer_model->update_data($id,$data);
		        if($update==1){
		          $this->session->set_flashdata('msg','Data successfully Updated');
		          // redirect('view_publication');
		          redirect(FOLDER_ADMIN.'/publication/view_publication');
		        }	    
	      }
	    }else{

	      $this->data['edit_data']=$this->Mayer_model->get_edit_data(base64_decode($this->input->get('id')),'publication');
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
	    $delete=$this->Mayer_model->delete_data($id, 'publication');

	    $this->session->set_flashdata('msg','Id number '.$id.' row data was deleted successfully');
	    // redirect('view_publication');
	    redirect(FOLDER_ADMIN.'/publication/view_publication');
  	}
  	
  	public function delete_publication_sub_category(){
	    $id = $this->input->get('id');
	    $delete=$this->Mayer_model->delete_data($id,'publicationsubcat');
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
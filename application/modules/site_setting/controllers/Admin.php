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
        $this->load->model('Site_model');
        $this->load->library('upload');
    }
    public function index()
    {
        # code...
    }
    public function site_setting(){
        $this->body=array();
        if($this->session->userdata('Language') == "nep") {
          //echo "inside nepali"; die;
          $this->body['site_info']=$this->Site_model->site_setting(2);
        }else{
          $this->session->set_userdata('Language','en');
          $this->body['site_info']=$this->Site_model->site_setting(1);
        }
       
        //var_dump($this->body['site_info']);
        //admin check
        $admin_type=$this->session->userdata('user_type');

        $this->body['admin']=$admin_type;
        //admin check
        $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/site_setting',$this->body);
    }
    public function site_setting_nep(){
        $this->body=array();
        $this->body['site_info']=$this->Site_model->site_setting(2);
        //var_dump($this->body['site_info']);

        //admin check
        $admin_type=$this->session->userdata('user_type');

        $this->body['admin']=$admin_type;
        //admin check
        $this->template
                              ->enable_parser(FALSE)
                              ->build('admin/site_setting_nep',$this->body);
        // $this->load->view('admin/header',$this->body);
        // $this->load->view('admin/site_setting_nep',$this->body);
        // $this->load->view('admin/footer');
    }
    public function update_site_text(){
        if( $_FILES['site_logo']['name']==''){
          var_dump($_POST);
          unset($_POST['submit']);
          $update=$this->Site_model->update_data($_POST,1);
          echo $update;
          if($update){
            $this->session->set_flashdata('msg','Site Logo and Site Text successfully Updated');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting');
          }else{
            //error
          }
        }else{
          $file_name = $_FILES['site_logo']['name'];
          $img_upload=$this->Site_model->do_upload($file_name,'site_logo');
          if($img_upload['status']==1){
            $ext=$img_upload['upload_data']['file_ext'];
            unset($_POST['submit']);
            $image_path=base_url().'uploads/site_setting/site_logo'.$ext ;
            $_POST['site_logo']=$image_path;
            $update=$this->Site_model->update_data($_POST,1);
            if($update){
              $this->session->set_flashdata('msg','Site Logo and Site Text successfully Updated');
                redirect(FOLDER_ADMIN.'/site_setting/site_setting');       
                 }else{
              echo 'errp';
            }
          }else{
            $code= strip_tags($img_upload['error']);
            $this->session->set_flashdata('msg', $code);
            redirect(FOLDER_ADMIN.'/site_setting/site_setting');
          }
        }
    }
    public function test()
    {
      if(isset($_POST['submit'])){
         //echo "<pre>"; print_r($this->input->post()); die;
          $file_name = $_FILES['project_pic']['name'];
          $data=array(
            'site_text'=>$this->input->post('site_text'),
            'site_name'=>$this->input->post('site_name')
          );
          $insert=$this->Site_model->update_data($data,2);
          if($insert){
            $old_image=$this->input->post('old_image');
            $img_upload=$this->Site_model->do_upload($file_name,$insert);
              if($img_upload['status']== 1) {
                @unlink($old_image);  
              $ext=$img_upload['upload_data']['file_ext'];
                $image_path=base_url() . 'uploads/drrinfo/'.$insert.$ext ; 
                
            }else{
              $id=$this->input->post('id');
              if($id) {
                $image_path =$old_image;
              }else{
                $code= strip_tags($img_upload['error']);
                $this->session->set_flashdata('msg', $code);
                redirect(FOLDER_ADMIN.'/site_setting/site_setting');  
              }
            }
            $img=array(
                  'image'=>$image_path,
              );
            $update_path=$this->DrrModel->update_path($insert,$img);
            $this->session->set_flashdata('msg','site successfully added');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting');
          }
      }
    }
    public function update_site_text_nep(){
        if( $_FILES['site_logo']['name']==''){
          // print_r($_FILES['site_logo']['name']);die;
          unset($_POST['submit']);
          $update=$this->Site_model->update_data($_POST,2);
          //  echo $update;
          if($update){
            $this->session->set_flashdata('msg','Site Logo and Site Text successfully Updated');
            // redirect('site_setting_nep');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting_nep');
          }else{
            //error
          }
        }else{
          $file_name = $_FILES['site_logo']['name'];
          $img_upload=$this->Site_model->do_upload($file_name,'site_logo');
          //print_r($img_upload);die;
          if($img_upload['status']==1){
            $ext=$img_upload['upload_data']['file_ext'];
            unset($_POST['submit']);
            $image_path=base_url().'uploads/site_setting/site_logo'.$ext ;
            $_POST['site_logo']=$image_path;
            $update=$this->Site_model->update_data($_POST,2);
            if($update){
              $this->session->set_flashdata('msg','Site Logo and Site Text successfully Updated');
              // redirect('site_setting_nep');
              redirect(FOLDER_ADMIN.'/site_setting/site_setting/site_setting');
            }else{
              echo 'errp';
            }
          }else{
            $code= strip_tags($img_upload['error']);
            $this->session->set_flashdata('msg', $code);
            redirect(FOLDER_ADMIN.'/site_setting/site_setting/site_setting');
          }
        }
    }
    public function update_cover_nep(){
        if( $_FILES['cover_photo']['name']==''){
          // var_dump($_POST);
          // exit();
          unset($_POST['submit']);
          $update=$this->Site_model->update_data($_POST,2);
          echo $update;
          if($update){
            $this->session->set_flashdata('msg','Cover Photo and Cover Text successfully Updated');
            // redirect('site_setting_nep');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting_nep');
          }else{
            //error
          }
        }else{
          $file_name = $_FILES['cover_photo']['name'];
          $img_upload=$this->Site_model->do_upload_cover($file_name,'cover_photo');
          if($img_upload['status']==1){
            $ext=$img_upload['upload_data']['file_ext'];
            unset($_POST['submit']);
            $image_path=base_url().'uploads/site_setting/cover_photo'.$ext ;
            $_POST['cover_photo']=$image_path;
            $update=$this->Site_model->update_data($_POST,2);
            if($update){
              $this->session->set_flashdata('msg','Cover Photo and Cover Text successfully Updated');
              // redirect('site_setting_nep');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting_nep');
            }else{
              echo 'errp';
            }
          }else{
            $code= strip_tags($img_upload['error']);
            $this->session->set_flashdata('msg', $code);
            // redirect('site_setting_nep');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting_nep');
          }
        }
    }
    public function update_cover(){
        if( $_FILES['cover_photo']['name']==''){
          // var_dump($_POST);
          // exit();
          var_dump($_POST);
          unset($_POST['submit']);
          $update=$this->Site_model->update_data($_POST,1);
          echo $update;

          if($update){
            $this->session->set_flashdata('msg','Cover Photo and Cover Text successfully Updated');
            // redirect('site_setting');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting');
          }else{
            //error
          }
        }else{
          $file_name = $_FILES['cover_photo']['name'];
          $img_upload=$this->Site_model->do_upload_cover($file_name,'cover_photo');
          if($img_upload['status']==1){
            $ext=$img_upload['upload_data']['file_ext'];
            unset($_POST['submit']);
            $image_path=base_url().'uploads/site_setting/cover_photo'.$ext ;
            $_POST['cover_photo']=$image_path;
            $update=$this->Site_model->update_data($_POST,1);
            if($update){
              $this->session->set_flashdata('msg','Cover Photo and Cover Text successfully Updated');
              // redirect('site_setting');
              redirect(FOLDER_ADMIN.'/site_setting/site_setting');
            }else{
              echo 'errp';
            }
          }else{
            $code= strip_tags($img_upload['error']);
            $this->session->set_flashdata('msg', $code);
            // redirect('site_setting');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting');
          }
        }
    }
    public function footer_text(){
        unset($_POST['submit']);
        $update=$this->Site_model->update_data($_POST,1);
        echo $update;
        if($update){
          $this->session->set_flashdata('msg','Footer Right Text successfully Updated');
          // redirect('site_setting');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting');
        }else{
          //error
        }
    }
    public function footer_text_nep(){
        unset($_POST['submit']);
        $update=$this->Site_model->update_data($_POST,2);
        echo $update;
        if($update){
          $this->session->set_flashdata('msg','social link updated successfully');
          // redirect('site_setting_nep');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting');
        }else{
          //error
        }
    }
    public function important_link_nep(){
        unset($_POST['submit']);
        $update=$this->Site_model->update_data($_POST,2);
        if($update){
          $this->session->set_flashdata('msg','Importnat Links successfully Updated');
          // redirect('site_setting_nep');
              redirect(FOLDER_ADMIN.'/site_setting/site_setting_nep');
        }else{
          //error
        }
    }
    public function important_link(){
          unset($_POST['submit']);
          $update=$this->Site_model->update_data($_POST,1);
          echo $update;
          if($update){
            $this->session->set_flashdata('msg','Importnat Links successfully Updated');
            // redirect('site_setting');
            redirect(FOLDER_ADMIN.'/site_setting/site_setting');
          }else{
            //error
          }
    }
    public function find_us_links(){
          unset($_POST['submit']);
          $update=$this->Site_model->update_data($_POST,1);
          echo $update;
          if($update){
          $this->session->set_flashdata('msg','Find us Links successfully Updated');
          // redirect('site_setting');
          redirect(FOLDER_ADMIN.'/site_setting/site_setting');
          }
    }
    public function find_us_links_nep(){
          unset($_POST['submit']);
          $update=$this->Site_model->update_data($_POST,2);
          //echo $update;
          if($update){
          $this->session->set_flashdata('msg','Find us Links successfully Updated');
          // redirect('site_setting_nep');
          redirect(FOLDER_ADMIN.'/site_setting/site_setting_nep');
          }
    }
    public function copyright_nep(){
          unset($_POST['submit']);
          $update=$this->Site_model->update_data($_POST,2);
          //echo $update;
          if($update){
          $this->session->set_flashdata('msg','Copy Right Text successfully Updated');
          // redirect('site_setting_nep');
          redirect(FOLDER_ADMIN.'/site_setting/site_setting_nep');
          }
    }
    public function copyright(){
          unset($_POST['submit']);
          $update=$this->Site_model->update_data($_POST,1);
          echo $update;
          if($update){
          $this->session->set_flashdata('msg','Copy Right Text successfully Updated');
          // redirect('site_setting');
          redirect(FOLDER_ADMIN.'/site_setting/site_setting');
          }
    } 
    public function map_zoom(){
          unset($_POST['submit']);
          $update=$this->Site_model->update_data($_POST,1);
          $update=$this->Site_model->update_data($_POST,2);
          echo $update;
          if($update){
          $this->session->set_flashdata('msg','Map zoom and center  successfully Updated');
          // redirect('site_setting');
          redirect(FOLDER_ADMIN.'/site_setting/site_setting');
          }
    }
    public function homepagesetup()
    {
        $this->data = array();
        $lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $language='en';
            $id ='1';
        }else{
            $language='nep';
            $id ='2'; 
        }
        $admin_type=$this->session->userdata('user_type');
        $this->data['admin']=$admin_type;
        $this->data['homepage'] = $this->general->get_tbl_data_result('*','homepagelabals',array('language'=>$language,'id'=>$id));
        //echo "<pre>"; print_r($this->data['homepage']); die;
        $this->form_validation->set_rules('muncipaldatatitle', 'Muncipaldatatitle Sub Category Name', 'trim|required');
        if ($this->form_validation->run() == TRUE){
            
            $trans = $this->Site_model->saveHomePageData('homepagelabals',$language,$id);
            if($trans)
            {
                $this->session->set_flashdata('msg','Homepage Labels successfully added');
                redirect(FOLDER_ADMIN.'/site_setting/homepagesetup');
            }
        }
        $this->template
          ->enable_parser(FALSE)
          ->build('admin/homepagesetup',$this->data);
    }
    public function beready()
    {
        $admin_type=$this->session->userdata('user_type');
        $this->data['admin']=$admin_type;
        $this->data=array();
        $lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
        
        $admin_type=$this->session->userdata('user_type');
        $this->data['admin']=$admin_type; 
        $this->data['drrdata'] = $this->general->get_tbl_data_result('id,image,name,description','beready',array('language'=>$emerg_lang));
        $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/bereadylist',$this->data);
    }
    public function beready_add() {
        $bnr_id = base64_decode($this->input->get('id'));
        $lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $language='en';
        }else{
            $language='nep'; 
        }
        $admin_type=$this->session->userdata('user_type');
            $this->data['admin']=$admin_type;
        $this->data['drrdataeditdata']=array();
        if(!empty($bnr_id))
        { 
            $bnr_data=$this->general->get_tbl_data_result('id,image,name,description','beready',array('id'=>$bnr_id));
            if(empty($bnr_data))
            {
                redirect(site_url(FOLDER_ADMIN.'/site_setting/beready'),'refresh');
            }
            $this->data['drrdataeditdata']=$bnr_data;
        }else{
        }
        $this->form_validation->set_rules('name', 'Image  Name', 'trim|required');
        //make file settins and do upload it                    
        if($this->form_validation->run()==TRUE )
        {       
            $trans = $this->Site_model->insert_update_beready($language);
            if($trans)
            {
               
                $this->session->set_flashdata('message','<span class="alert alert-success">Successfully Created!!.</span>');
            }
            else
            {
                $this->session->set_flashdata('message','<span class="alert alert-danger">Operation Unsuccessful !!</span>');   
            }
            redirect(FOLDER_ADMIN.'/site_setting/beready','refresh');
            exit;
        }
        $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/addbeready',$this->data);
    }
    public function sliderList()
    {
        $admin_type=$this->session->userdata('user_type');
        $this->data['admin']=$admin_type;
        $this->data=array();
        $lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
        
        $admin_type=$this->session->userdata('user_type');
        $this->data['admin']=$admin_type; 
        $this->data['drrdata'] = $this->general->get_tbl_data_result('id,image,name','homepageslider',array('language'=>$emerg_lang));
        $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/sliderlist',$this->data);
    }
    public function sliderHome() {
        $bnr_id = base64_decode($this->input->get('id'));
        $lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $language='en';
        }else{
            $language='nep'; 
        }
        $admin_type=$this->session->userdata('user_type');
            $this->data['admin']=$admin_type;
        $this->data['drrdataeditdata']=array();
        if(!empty($bnr_id))
        { 
            $bnr_data=$this->general->get_tbl_data_result('id,image,name,description','homepageslider',array('id'=>$bnr_id));
            if(empty($bnr_data))
            {
                redirect(site_url(FOLDER_ADMIN.'/site_setting/sliderList'),'refresh');
            }
            $this->data['drrdataeditdata']=$bnr_data;
        }else{
        }
        $this->form_validation->set_rules('name', 'Image  Name', 'trim|required');
        //make file settins and do upload it                    
        if($this->form_validation->run()==TRUE )
        {    
            //echo "<pre>"; print_r($this->input->post());die;       
            $trans = $this->Site_model->insert_update_Banner($language);
            if($trans)
            {
               
                $this->session->set_flashdata('message','<span class="alert alert-success">Successfully Created!!.</span>');
            }
            else
            {
                $this->session->set_flashdata('message','<span class="alert alert-danger">Operation Unsuccessful !!</span>');   
            }
            redirect(FOLDER_ADMIN.'/site_setting/sliderList','refresh');
            exit;
        }
        $this->template
                        ->enable_parser(FALSE)
                        ->build('admin/addslider',$this->data);
    }
    public function deleteslider(){
        $tbl="homepageslider";
        $id = base64_decode($this->input->get('id'));
        $delete=$this->Site_model->deleteslider($id,$tbl);
        if($delete){
            $this->session->set_flashdata('msg','Successfully Deleted');
            redirect(FOLDER_ADMIN.'/site_setting/sliderList');
        }
    }
     public function deletebeready(){
        $tbl="beready";
        $id = base64_decode($this->input->get('id'));
        $delete=$this->Site_model->deleteslider($id,$tbl);
        if($delete){
            $this->session->set_flashdata('msg','Successfully Deleted');
            redirect(FOLDER_ADMIN.'/site_setting/sliderList');
        }
    }
}
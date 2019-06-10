<?php
class DrrModel extends CI_Model {
  public function get_all_data(){

    $this->db->select('*');
    $this->db->order_by('id','DESC');
    $q=$this->db->get('drrcategory');
    return $q->result_array();
  }
   
    public function add_drrinfo($table,$data){
        $id=$this->input->post('id');
        if($id)
        {
            if($this->db->update($table,$data,array('id'=>$id)))
            { 
              return $id;
            }
        }else{
            $this->db->insert($table,$data);
            if ($this->db->affected_rows() > 0)
            {
            return $this->db->insert_id();
            }
            else
            {
                $error = $this->db->error();
                return $error;
            }
        }
    }
    public function update_path_drrinformation($id,$data){

        $this->db->where('id',$id);
        $this->db->update('drrinformation',$data);

    }
    public function update_path($id,$data){

        $this->db->where('id',$id);
        $this->db->update('drrcategory',$data);

    }

    public function do_upload($filename,$name)
    {

        $field_name                     ='project_pic';
        $config['upload_path']          = './uploads/drrinfo/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 7000;
        $config['overwrite']            = TRUE;
        $config['file_name']           = $name;

        $this->load->library('upload', $config);
        // changes for image resize
           // $this->resize_image(GALLERY_PATH, $imgfile, 'thumb_'.$imgfile,157,117);
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/drrinfo/'.$name;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 100;
            $config['height'] = 100;
            $config['master_dim'] = 'width';
            $config['new_image'] = './uploads/drrinfo/'.'_thumb'.$name;
            //print_r($name);die;
            $this->load->library('image_lib');
           // $this->image_lib->initialize($config);
            //$resize = $this->image_lib->resize();
        // changes for image resize
        if ( ! $this->upload->do_upload($field_name))
        {
          $error = array('error' => $this->upload->display_errors());
          return $error;


        }
        else
        {


          $data = array('upload_data' => $this->upload->data());
            $data['status']=1;
      // echo "hello"; print_r($data); die;
          return $data;


        }
    }
    public function do_upload_drrinfo($filename,$name)
    {
        $field_name                     ='image';
        $config['upload_path']          = './uploads/drrinformation/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 7000;
        $config['overwrite']            = TRUE;
        $config['file_name']           = $name;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($field_name))
        {
          $error = array('error' => $this->upload->display_errors());
          return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $data['status']=1;
            // echo "hello"; print_r($data); die;
            return $data;
        }
    }
    public function delete($id,$tbl){
        $this->db->where('id',$id);
        return $this->db->delete($tbl);
    }

    public function get_edit_Data($id,$table){

        $this->db->select('*');
        $this->db->where('id',$id);
        $query=$this->db->get($table);
        return $query->row_array();


    }

    public function update_data($id,$data){

      $this->db->where('id',$id);
      $q=$this->db->update('drrcategory',$data);
      if($q){
        return 1;
      }else{
        return 0;
      }

    }
    public function only_information($id)
    {
        $this->db->select('subcat_id');
        $this->db->from('drrinformation');
        $this->db->group_by('subcat_id');
        $this->db->where('category_id',$id);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0)
        {
            return $data=$query->result_array();
        } 
        return false;
    }
    public function only_information_id($cond)
    {
        $this->db->select('name,id,slug');
        $this->db->from('drrsubcategory');
        $this->db->where_in("id",$cond);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0)
        {
            return $data=$query->result_array();
        } 
        return false;
    }
    public function get_drrlist($cond =false)
    {
        $this->db->select('d.id as id,d.short_desc,c.name as categoryname,cs.name as subcatname');
        $this->db->from('drrinformation as d');
        $this->db->join('drrcategory as c','c.id = d.category_id','LEFT');
        $this->db->join('drrsubcategory as cs','cs.id = d.subcat_id','LEFT');
        if($cond) {
          $this->db->where($cond); //change
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $data=$query->result_array();
        } 
        return false;
    }
    public function file_do_upload($filename,$name)
    {
      $field_name                     ='uploadedfile';
      $config['upload_path']          = './uploads/drr_article/file/';
      $config['allowed_types']        = 'pdf|doc';
      $config['max_size']             = 7000;
      $config['overwrite']            = TRUE;
      $config['file_name']           = $name;
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      //var_dump($field_name); die;
      if ( ! $this->upload->do_upload($field_name))
      {
        $error = array('error' => $this->upload->display_errors());
        return $error;


      }
      else
      {


        return 1;

      }
    }
    public function update_path_drrarticle($id,$data){

        $this->db->where('id',$id);
        $this->db->update('drr_article',$data);

    }
    public function add_sliderimages()
    {
        $error = true;
        $loop = 0;
        $gly_title = $this->input->post('title');
        $gly_content = $this->input->post('short_summary');
        $gly_catid = $this->input->post('id');
        foreach($gly_content as $key => $value) {
            $_FILES['gallery']['name'] = $_FILES['gly_path']['name'][$key];
            $_FILES['gallery']['type'] = $_FILES['gly_path']['type'][$key];
            $_FILES['gallery']['tmp_name'] = $_FILES['gly_path']['tmp_name'][$key];
            $_FILES['gallery']['error'] = $_FILES['gly_path']['error'][$key];
            $_FILES['gallery']['size'] = $_FILES['gly_path']['size'][$key];
            if (!empty($_FILES))
            {
                $new_image_name = $_FILES['gly_path']['name'][$key];
                //echo "<pre>";print_r($new_image_name);die;
                $imgfile = $this->douploadgallery('gallery');
                $imagename= base_url().'uploads/hazadr_gallerys/'.$imgfile;
                //print_r($imagename);die;
                //$this->resize_image(GALLERY_PATH, $imgfile, 'thumb_'.$imgfile, 157, 117); //55,74
            } else
            {
                $imgfile = '';
            }
            $dataArray[] = array(
                    'title' => $gly_title[$key],
                    'gly_path' =>$imagename,
                    'short_summary'=> $gly_content,
                    'hazard_id'=>$gly_catid
            );
        }
        // print_r($dataArray);die(); 
        if (!empty($dataArray))
        {
            $this->db->insert_batch('hazard_slider', $dataArray);
            $rowaffected = $this->db->affected_rows();
            if ($rowaffected)
            {
                return $rowaffected;
            }
            return false;
        }
        return false;
    }
    public function douploadgallery($file) {
        $config['upload_path'] = './'.GALLERY_PATH;
        $config['allowed_types'] = 'png|jpg|gif|jpeg ';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;    
        $config['max_size'] = '20000000';
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        $this->upload->do_upload($file);
        $data = $this->upload->data();
        //echo "<pre>"; echo "file: ";print_r($file);echo "<br/>";echo "Data: ";print_r($data);exit;
        $name_array = $data['file_name'];
            // echo $name_array;exit;
            // $names= implode(',', $name_array);   
            // return $names;
        return $name_array;
    }
    public function get_hazard_images($cond =false)
    {
        $this->db->select('dc.name,"hs.id", "hs.title", "hs.gly_path", "hs.short_summary"');
        $this->db->from('hazard_slider as hs');
        $this->db->join('drrcategory as dc','dc.id = hs.hazard_id','LEFT');
        if($cond) {
          $this->db->where($cond); //change
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $data=$query->result_array();
        } 
        return false;
    }
}

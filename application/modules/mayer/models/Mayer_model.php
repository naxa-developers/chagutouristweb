<?php
class Mayer_model extends CI_Model {



  public function get_all_data(){

        $this->db->select('*');
        $this->db->order_by('id','DESC');
        $q=$this->db->get('publication');
        return $q->result_array();
  }

public function add_publication($table,$data){

$this->db->insert($table,$data);
//echo "<pre>";print_r($data);die;
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

  public function update_path($id,$data){

    $this->db->where('id',$id);
    $this->db->update('mayermessage',$data);

  }

  public function do_upload($filename,$name)
  {

    $field_name                     ='proj_pic';
    $config1['upload_path']          = './uploads/publication/';
    $config1['allowed_types']        = 'gif|jpg|jpeg|png|JPEG|JPG|gif|jpg|png|jpg|jpeg|jpe|gif|png';
    $config1['max_size']             = 7000000;
    $config1['overwrite']            = TRUE;
    $config1['max_width']  = '3000';
    $config1['max_height']  = '1900';
    $config1['file_name']           = $name;
    $this->load->library('upload', $config1);
    $this->upload->initialize($config1);
    $data = $this->upload->data();
       //echo "<pre>"; print_r( $data );die; 
    if (!$this->upload->do_upload($field_name))
    {
      $error = array('error' => $this->upload->display_errors());
      return $error;
    }
    else
    {
      $data = array('upload_data' => $this->upload->data());
        $data['status']=1;
        //print_r($data);die;
      return $data;

    }
  }

  public function file_do_uploa_audiod($filename,$name)
  {
        $configVideo['upload_path']          = './uploads/publication/file/';
          $configVideo['max_size'] = '10240';
          $configVideo['allowed_types'] = 'avi|flv|wmv|mp3|mpeg|mpg|mp4|mpe|qt|mov|m4a';
          $configVideo['overwrite'] = FALSE;
          $configVideo['remove_spaces'] = TRUE;
          //$video_name = $date.$_FILES['audio']['name'];
            $configVideo['overwrite']            = TRUE;
            $configVideo['file_name']           = $name;
          //$configVideo['file_name'] = $filename;

          $this->load->library('upload', $configVideo);
          $this->upload->initialize($configVideo);
          $data = $this->upload->data();
          //echo"<pre>";print_r($data); die;
          $pathp = $data['full_path'];
        
          if ( ! $this->upload->do_upload('audio'))
          {
            $error = array('error' => $this->upload->display_errors());
            return $error;


          }
          else
          {


           return 1;

    }
  }


  public function file_do_upload($filename,$name)
  {

    $field_name                     ='uploadedfile';
    $config['upload_path']          = './uploads/publication/file/';
    $config['allowed_types']        = 'pdf|doc|docx';
    $config['max_size']             = 7000;
    $config['overwrite']            = TRUE;
    $config['file_name']           = $name;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

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

  public function delete_data($id,$tablename){


    $this->db->where('id',$id);
    $this->db->delete($tablename);
  }

  public function get_edit_Data($id,$table){

  $this->db->select('*');
  $this->db->where('id',$id);
  $query=$this->db->get($table);
  return $query->row_array();


  }

  public function update_data($id,$data){

    $this->db->where('id',$id);
    $q=$this->db->update('publication',$data);
    if($q){
      return 1;
    }else{
      return 0;
    }

  }
  public function add_publiactioncat($table,$data){
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
    public function get_publication_filecat()
    {  
      $this->db->select('p.id as id,pc.name as category,p.name as file');
      $this->db->from('publicationfilecat as p');
      $this->db->join('publicationsubcat as pc','pc.id = p.sub_cat_id','LEFT');
      $query = $this->db->get();
      //echo $this->db->last_query();die;
      if ($query->num_rows() > 0)
      {
          return $data=$query->result_array();
      } 
      return false;
  }
  public function get_publication()
  {  
      $keywords =  $this->input->post('keywords');
      $category =  $this->input->post('category');
      $broucher =  $this->input->post('brouchure');
      $audio =  $this->input->post('audio');
      $video =  $this->input->post('video');
      $other =  $this->input->post('other');

      $document =  $this->input->post('document');
      $type =  $this->input->post('type');
      $subcat =  $this->input->post('subcat');
      $this->db->select('p.type,p.id,p.title,p.summary,p.photo,p.file,p.videolink,p.audio,pc.name');
      $this->db->from('publication as p');
      $this->db->join('publicationcat as pc','pc.id = p.category','LEFT');
      if($keywords)
      {
        $sql = "p.title LIKE '%" . $keywords ."%' OR p.type LIKE '%" . $keywords ."%' OR p.summary LIKE '%". $keywords."%'";
        $this->db->where($sql);
      }
      if($other)
      {
         $this->db->where_in('p.filecat',$other);
      }
      if($audio)
      {
          $this->db->where_in('p.filecat',$audio);
      }
      if($video)
      {
          $this->db->where_in('p.filecat',$video);
      }
      if($document)
      {
          $this->db->where_in('p.filecat',$document);
      }
      if($broucher)
      {
          $this->db->where_in('p.filecat',$broucher);
      }
      
      if($category !="all")
      {
        if($category)
        {
          $this->db->where('p.category',$category);
        }
        
      }
      if($subcat)
      {
          $this->db->where('p.subcat',$subcat);
      }
      if($type)
      {
          $this->db->where('p.type',$type);
      }
      $query = $this->db->get();
      //echo $this->db->last_query();die;
      if ($query->num_rows() > 0)
      {
          return $data=$query->result_array();
      } 
      return false;
  }
  public function publication_search($cond = false)
  {  
      $keywords =  $this->input->post('keywords');
      $category =  $this->input->post('category');
      $broucher =  $this->input->post('brouchure');
      $audio =  $this->input->post('audio');
      $video =  $this->input->post('video');
      $document =  $this->input->post('document');
      $type =  $this->input->post('type');
      $subcat =  $this->input->post('subcat');
      $this->db->select('p.type,p.id,p.title,p.summary,p.photo,p.file,p.videolink,pc.name');
      $this->db->from('publication as p');
      $this->db->join('publicationcat as pc','pc.id = p.category','LEFT');
      if($keywords)
      {
        $sql = "p.title LIKE '%" . $keywords ."%' OR p.type LIKE '%" . $keywords ."%' OR p.summary LIKE '%". $keywords."%'";
        $this->db->where($sql);
      }
      if($audio)
      {
          $this->db->where('p.filecat',$audio);
      }
      if($video)
      {
          $this->db->where('p.filecat',$video);
      }
      if($document)
      {
          $this->db->where('p.filecat',$document);
      }
      if($broucher)
      {
          $this->db->where('p.filecat',$broucher);
      }
      if($cond)
      {
          $this->db->where('p.type',$cond);
      }
      if($category !="all")
      {
        if($category)
        {
          $this->db->where('p.category',$category);
        }
        
      }
      if($subcat !="all")
      {
        if($subcat){
          $this->db->where('p.subcat',$subcat);
        }
      }
      if($type)
      {
          $this->db->where('p.type',$type);
      }
      $query = $this->db->get();
      //echo $this->db->last_query();die;
      if ($query->num_rows() > 0)
      {
          return $data=$query->result_array();
      } 
      return false;
  }
  public function get_publication_data()
  { 
   
    $this->db->select('*');
    $this->db->from('publicationsubcat as p');
    
    $this->db->where_in('slug',array('brouchure','documents'));
   
    $query = $this->db->get();
    //echo $this->db->last_query();die;
    if ($query->num_rows() > 0)
    {
        return $data=$query->result_array();
    } 
    return false;
  }
  public function get_publication_details($id=false)
  { 
    $id = base64_decode($this->input->get('id'));
    $this->db->select('p.type,p.id,p.title,p.summary,p.photo,p.file,p.videolink,p.audio,pc.name');
    $this->db->from('publication as p');
    $this->db->join('publicationcat as pc','pc.id = p.category','LEFT');
    if($id) {
        $this->db->where('p.id',$id);
    }
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    if ($query->num_rows() > 0)
    {
        return $data=$query->result_array();
    } 
    return false;
  }
   public function get_publication_search()
  {
    $this->db->select('p.type,p.id,p.title,p.summary,p.photo,p.file,p.videolink,p.audio,pc.name');
    $this->db->from('publication as p');
    $this->db->join('publicationcat as pc','pc.id = p.category','LEFT');
    
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    if ($query->num_rows() > 0)
    {
        return $data=$query->result_array();
    } 
    return false;
  }
}

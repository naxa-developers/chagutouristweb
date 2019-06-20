<?php
class Map_model extends CI_Model {

  public function get_summary_list($tbl){

    $this->db->select('*');
    $this->db->where('category_table',$tbl);
    $q=$this->db->get('categories_tbl');
    return $q->row_array();
  }





  public function get_as_map_data($d,$tbl){

    foreach($d as $v){
    $this->db->select($v['eng_lang'].' AS '. $v['nepali_lang']);
    }

    $this->db->order_by('id','ASC');
    $q=$this->db->get($tbl);
    return $q->result_array();


  }

  public function update_path($id,$data,$tbl){
    $this->db->where('id',$id);
    $this->db->update($tbl,$data);

  }
  public function get_jsn($tbl){



    $this->db->select('column_control');
    $this->db->where('category_table',$tbl);
    $q=$this->db->get('categories_tbl');
    return $q->row_array();
  }


  public function get_data_con($d,$tbl){

    for($i=0; sizeof($d['a'])>$i; $i++){
    $this->db->select($d['a'][$i]['col'].' AS '. $d['a'][$i]['name']);
    }

    $this->db->order_by('id','ASC');
    $q=$this->db->get($tbl);

    return $q->result_array();


  }



  public function get_map_filter_data($tbl,$query,$d){
    foreach($d as $v){
      //$this->db->select($v['eng_lang'].' AS '.pg_escape_string(preg_replace('/[^A-Za-z0-9\-]/', ' ', $v['nepali_lang'])));

      $this->db->select($v['eng_lang'].' AS '. $v['nepali_lang']);
    }
   $this->db->where($query);
   $res=$this->db->get($tbl);
   return $res->result_array();


  }

  public function get_map_filter_data_en($tbl,$query,$d){
    foreach($d as $v){
     $this->db->select($v['eng_lang'].' AS '.pg_escape_string(preg_replace('/[^A-Za-z0-9\-]/', ' ', $v['nepali_lang'])));

      //$this->db->select($v['eng_lang'].' AS '. $v['nepali_lang']);
    }
   $this->db->where($query);
   $res=$this->db->get($tbl);
   return $res->result_array();


  }


  public function get_map_filter_data_csv($tbl,$query,$d){
    foreach($d as $v){
    $this->db->select($v['eng_lang'].' AS '.pg_escape_string(preg_replace('/[^A-Za-z0-9\-]/', ' ', $v['nepali_lang'])));
    }
   $this->db->where($query);
   $res=$this->db->get($tbl);
   return $res;


  }

  public function get_map_download_data()
  {
    $this->db->select('*');
    $this->db->order_by('id','DESC');
    $query=$this->db->get('maps_download');
    return $query->result_array();

  }

  public function get_summary($field,$tbl){


    $this->db->select($field.' AS field');
    $this->db->select('ST_AsGeoJSON(the_geom)');
    $query=$this->db->get($tbl);
    return $query->result_array();

  }

  public function default_load(){
    $this->db->select('default_load');
    $this->db->order_by('id','ASC');
    $query=$this->db->get('categories_tbl');
    return $query->result_array();


  }


  public function get($tbl){


    $this->db->select('*');
    $this->db->select('ST_AsGeoJSON(the_geom)');
    $query=$this->db->get($tbl);
    return $query->result_array();
  }



  public function get_cat_map($tbl){
    $this->db->select('*');
    $this->db->order_by('id','ASC');
    $query=$this->db->get($tbl);
    return $query->result_array();
  }


  public function get_layer($tbl){
    $this->db->select('*');
    $this->db->order_by('id','ASC');
    $query=$this->db->get($tbl);
    return $query->result_array();
  }

  public function get_layer_en($tbl,$cat){
    $this->db->select('*');
    $this->db->where('language','en');
      $this->db->where('category_type',$cat);
    $this->db->order_by('id','ASC');
    $query=$this->db->get($tbl);
    return $query->result_array();
  }

  public function get_layer_all_en($tbl){
    $this->db->select('*');
    $this->db->where('language','en');
    $this->db->order_by('id','ASC');
    $query=$this->db->get($tbl);
    return $query->result_array();
  }

  public function get_layer_nep($tbl,$cat){
    $this->db->select('*');
    $this->db->where('language','nep');
    $this->db->where('category_type',$cat);
    $this->db->order_by('id','ASC');
    $query=$this->db->get($tbl);
    return $query->result_array();
  }

  public function get_layer_all_nep($tbl){
    $this->db->select('*');
    $this->db->where('language','nep');

    $this->db->order_by('id','ASC');
    $query=$this->db->get($tbl);
    return $query->result_array();
  }



  public function get_popup($tbl){
    $this->db->select('*');
    $this->db->order_by('id','ASC');
    $this->db->where('tbl_name',$tbl);
    $query=$this->db->get('tbl_lang');
    return $query->result_array();
  }

  public function get_summary_single($tbl){
    $this->db->select('*');
    $this->db->where('category_table',$tbl);
    $query=$this->db->get('categories_tbl');
    return $query->row_array();
  }


  public function get_nep($tbl,$typ){

    $this->db->select('*');
    $this->db->order_by('id','ASC');
    $this->db->where('tbl_name',$typ);
    $q=$this->db->get($tbl);
    return  $q->result_array();


  }

  public function get_lang_map_data($tbl){

    $this->db->select('*');
    $this->db->where('tbl_name',$tbl);
    $q=$this->db->get('tbl_lang');
    return $q->result_array();
  }
 public function get_checkedcolumns_control($tbl){

    $this->db->select('column_control,popup_content');

    $this->db->where('category_table',$tbl);
    $q=$this->db->get('categories_tbl');
    return  $q->row_array();

  }
  public function get_checkedcolumns($tbl){

    $this->db->select('popup_content');

    $this->db->where('category_table',$tbl);
    $q=$this->db->get('categories_tbl');
    return  $q->row_array();

  }
  public function col_name($tbl){

    $this->db->select('*');

    $this->db->where('tbl_name',$tbl);
    $q=$this->db->get('tbl_lang');
    return  $q->result_array();



  }
  public function update_popup($tbl,$data){

    $this->db->where('category_table',$tbl);
    $q=$this->db->update('categories_tbl',$data);



  }

  public function update_style($tbl,$data){

    $this->db->where('category_table',$tbl);
    $q=$this->db->update('categories_tbl',$data);

  }


  public function update_value($id,$data){
    $this->db->where('id',$id);
    $this->db->update('categories_tbl',$data);
    return TRUE;

  }

  public function do_upload($filename,$name)
  {

    $field_name                     ='map_pic';
    $config['upload_path']          = './uploads/map_download/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 15000;
    $config['overwrite']             = TRUE;
    $config['file_name']           = $name;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload($field_name))
    {
      $error = array('error' => $this->upload->display_errors());
      $error['status']=0;
      return $error;


    }
    else
    {


      $data = array('upload_data' => $this->upload->data());

      $data['status']=1;

      return $data;

    }
  }


  public function update_map_download($id,$data,$tbl){

    $this->db->where('id',$id);
    return $this->db->update($tbl,$data);


  }

  public function insert_map_download($data){

    $this->db->insert('maps_download',$data);
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


public function delete_map($id)
{
$this->db->where('id',$id);
$this->db->delete('maps_download');

}

public function e_data_map($id){

$this->db->select('*');
$this->db->where('id',$id);
$query=$this->db->get('maps_download');
return $query->row_array();

}

public function get_icon(){

 $this->db->select('*');
 $res=$this->db->get('map_marker');
 return $res->result_array();


}

//new model data added from here


  public function get_data_geojson($d,$tbl){
    $siz =!empty(sizeof($d['a']))?sizeof($d['a']):0;
    for($i=0; $siz >$i; $i++){
    //$this->db->select($d['a'][$i]['col'].' AS '.  $d['a'][$i]['name']);
    $this->db->select($d['a'][$i]['col'].' AS '. pg_escape_string(str_replace(".","",$d['a'][$i]['name'])));
    }
    $this->db->select('ST_AsGeoJSON(the_geom)');
    $this->db->order_by('id','ASC');
    $q=$this->db->get($tbl);
   return $q;
  }
  public function get_data_selected($d,$tbl){
    for($i=0; sizeof($d['a'])>$i; $i++){
    $this->db->select($d['a'][$i]['col'].' AS '. pg_escape_string(str_replace(".","",$d['a'][$i]['name'])));
    }
    $this->db->order_by('id','ASC');
    $q=$this->db->get($tbl);
   return $q;
  }
  public function image_add_more()
  {
    $error = true;
    $loop = 0;
    $id = $this->input->post('id');
    $table = $this->input->post('nid');
    $type = $this->input->post('type');
    $gly = $_FILES['gly_path']['name'];
    //echo "<pre>";print_r($table);die;
    foreach($gly as $key => $value) {
        $_FILES['gallery']['name'] = $_FILES['gly_path']['name'][$key];
        $_FILES['gallery']['type'] = $_FILES['gly_path']['type'][$key];
        $_FILES['gallery']['tmp_name'] = $_FILES['gly_path']['tmp_name'][$key];
        $_FILES['gallery']['error'] = $_FILES['gly_path']['error'][$key];
        $_FILES['gallery']['size'] = $_FILES['gly_path']['size'][$key];
        if (!empty($_FILES))
        {
            $new_image_name = $_FILES['gly_path']['name'][$key];
            //echo "<pre>";print_r($new_image_name);die;
            if($type == "image" || $type == "threesixty")
            {
              $imgfile = $this->douploadgallery('gallery');
              $imagename= base_url().'uploads/sliderimage/'.$imgfile;
            }
            if($type == "audio" || $type == "video")
            {
              $audiofile = $this->file_do_uploa_audiod('gallery',$id);
              //print_r($imgfile);die;
              $imagename= base_url().'uploads/audiovideo/'.$audiofile;
            }
            //$this->resize_image(GALLERY_PATH, $imgfile, 'thumb_'.$imgfile, 157, 117); //55,74
        } else
        {
            $imgfile = '';
        }
        $dataArray[] = array(
                $imagename,
        );
        //echo "<pre>";print_r($dataArray);die;
    }
    if($type == "image")
    {
      $tet =array("a6"=>json_encode($dataArray,JSON_NUMERIC_CHECK));
    }
    if($type == "threesixty")
    {
      $tet =array("a8"=>json_encode($dataArray,JSON_NUMERIC_CHECK));
    }
    if($type == "audio")
    {
      $tet =array("a9"=>json_encode($dataArray,JSON_NUMERIC_CHECK));
    }
    if($type == "video")
    {
      $tet =array("a7"=>json_encode($dataArray,JSON_NUMERIC_CHECK));
    }
    if (!empty($dataArray))
    {  
      //echo "<pre>";print_r($tet);die;
      //$this->db->update('h',$tet,array('id'=>$id));
      //echo $this->db->last_query();die;
      if($this->db->update($table,$tet,array('id'=>$id)))
      { 
        return $id;
      }
    }
    return false;
  }
  public function file_do_uploa_audiod($filename,$id)
  {
    $configVideo['upload_path']          = './uploads/audiovideo/';
    $configVideo['max_size'] = '10240';
    $configVideo['allowed_types'] = 'avi|flv|wmv|mp3|mpeg|mpg|mp4|mpe|qt|mov';
    $configVideo['overwrite'] = FALSE;
    $configVideo['remove_spaces'] = TRUE;
    $configVideo['file_name'] = $id.$_FILES['gallery']['name'];
    $configVideo['overwrite']            = TRUE;
    //$configVideo['file_name']           = $name;
    //$configVideo['file_name'] = $filename;
    $this->load->library('upload', $configVideo);
    $this->upload->initialize($configVideo);
    $data = $this->upload->data();
    $name_array = $data['file_name'];
    //echo "<pre>";print_r($name_array); die;
    $pathp = $data['full_path'];
    if ( ! $this->upload->do_upload('gallery'))
    {
      $error = array('error' => $this->upload->display_errors());
      return $error;
    }
    else
    {
     return $name_array;
    }
  }
  public function douploadgallery($file) {
    $config['upload_path'] = './'.GALLERY_PATH;
    $config['allowed_types'] = 'png|jpg|gif|jpeg|JPEG';
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
}//end

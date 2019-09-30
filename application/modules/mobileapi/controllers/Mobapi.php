<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobapi extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->load->model('Api_model');
    $this->load->model('Table_model');

    $api_key = $this->input->post('api_key');
    if(APP_SECRET_KEY != $api_key)
    {
      //Client do not have right permission to access the server....
      //forbidden.....
      //  http_response_code(403);
      $this->output->set_output(json_encode(array('status' => false, 'message' => 'invalid Api Key')))->_display();
      exit;
    }
  }


    public function language()
    {
      $data=$this->general->get_tbl_data_result('name,language,alias','publicationsubcat');//this is language table
      $response['error'] = 0 ;
      $response['message'] = 'List Of Unverified report';
      $response['data'] = $data;
      echo json_encode($response);
      
    }
    public function touristInformation()
    {
      $lang = $this->input->post('language');
      $data=$this->general->get_tbl_data_result('*','touristinformation',array('language'=>$lang));//this is language table
      $response['error'] = 0 ;
      $response['message'] = 'List Of Tourist Information';
      $response['data'] = $data;
      echo json_encode($response);
    }
    public function place_details_api()
    {
      $data=$this->general->get_tbl_data_result('id,"rating" as FID,"description" as Description,"image" as Photo,"image" as Primary image,"image" as Images,"language" as Language,"audio" as Audio,"video" as Videos,"longitude" as Longitude,"latitude" as Latitude,"qrcode"  as QR code,"title" as Name,"slug" as place type','locationinformation');//this is language table
      $response['error'] = 0 ;
      $response['message'] = 'List Of Places';
      $response['data'] = $data;
      echo json_encode($response);
    }
    public function mayerMessage()
    {
      $data=$this->general->get_tbl_data_result('*','mayermessage');//this is language table
      $response['error'] = 0 ;
      $response['message'] = 'Mayer message';
      $response['data'] = $data;
      echo json_encode($response);
      
    }
    
  public function checkNregistration(){ //checking of new user or already registered and reigistering
    $data=$this->input->post('data');
    //var_dump($data);                     //getting data from api
    if($data){                           //1.check data is empty / notS
      $data_array = json_decode($data, true);
      $email=$data_array['email'];
      //var_dump($email);
      $getuser=$this->Api_model->getuser(); //get array of username from databasae
      if (in_array($email,$getuser, true)) {  //5.checking num exists or not
        $response['error'] = 0;
        $response['message'] = 'User is already exist';
      }else{
        $this->data['maxid'] = $this->general->get_tbl_data_result('"max"(user_id) as id','users');
        $datafinal=array(
            'username'=>$data_array['name'],
            'token'=>'CTG'.$this->data['maxid'][0]['id'],
            'email'=>$data_array['email'],
            'gender'=>$data_array['gender'],
            'purpose'=>$data_array['purpose_of_visit'],
            //'contact_num'=>$data_array['contact_num'],
            //'start_date'=>$data_array['start_date'],
            //'end_date'=>$data_array['end_date'],
            'country'=>$data_array['country']
              );
        //echo "<pre>";print_r($datafinal);die;
        $register=$this->Api_model->register('users',$datafinal);       //inserting data in table & parsing 1 parameter data array with column name and value
        if($register){           //3.check if data inserted or not
          $response['error'] = 0;
          $response['message'] = 'Registered successfully';
        }else{
          $response['error'] = 1;
          $response['message'] = 'Registration failed';
        }                          //3
      }
    }else{                           //2.if empty send no data response
      $response['error'] = 1 ;
      $response['message'] = 'No data';
    }
    echo json_encode($response);
  }
  public function  authCheck(){
    $data=$this->input->post('data');   //getting data from api
    if($data){                           //1.check data is empty / not
      $data_array = json_decode($data, true);
      $token=$data_array['token'];
      $tokencheck=$this->general->get_tbl_data_result('token','users',array('token'=>$token));
      if($tokencheck) {  //5.checking num exists or not
        //$tokencheck=$this->Api_model->check_auth('users',$token); 
        $date =date('Y-m-d');
        $expiredate=$this->general->get_tbl_data_result('end_date as expiredate','users',array('token'=>$token));
        //print_r($expiredate[0]['expiredate']);die;
        $token=$this->general->get_tbl_data_result('token','users',array('end_date >='=>$date,'token'=>$token));
        //echo $this->db->last_query();die;
        if($token)
        {
          $response['error'] = 0;
          $response['message'] = 'Valid user';
          $response['date'] = $expiredate[0]['expiredate'];
        }else{
          $response['error'] = 1;
          $response['message'] = 'Your token is expired Please Contact to service provider !!';
          $response['data'] = null;
        }
      }else{
        $response['error'] = 1;
        $response['message'] = 'Invalid user';       //inserting data in table & parsing 1 parameter data array with column name and value
        $response['data'] = null;
      }
    }else{
      $response['error'] = 1 ;
      $response['message'] = 'No data';
    }
    echo json_encode($response);
  }
  public function registerUser() {  //register user
    $data=$this->input->post('data');
    if($data){  
      $data_array = json_decode($data, true);
      $this->data['maxid'] = $this->general->get_tbl_data_result('"max"(user_id) as id','users');
      $register=$this->Api_model->register('users',$data_array);       //inserting data in table & parsing 1 parameter data array with column name and value
      if($register){           //3.check if data inserted or not
        $response['error'] = 0;
        $response['message'] = 'Registered successfully';
      }else{
        $response['error'] = 1;
        $response['message'] = 'Registration failed';
      }  
    }else{
      $response['error'] = 1 ;
      $response['message'] = 'No data';
    }
    echo json_encode($response);
  }
  public function check_registered_num(){
    $data=$this->input->post('data');
                    //getting data from api

    if($data){

      //$ph_data=$this->Api_model->get_num();
      $data_array=json_decode($data,TRUE);
      $registered_number=array();
      // var_dump(sizeof($data_array));
      // exit();
      $get_mob=$this->Api_model->get_mobile_no();


    for($i=0;$i<sizeof($data_array);$i++){



        if (in_array($data_array[$i]['mobile_no'],$get_mob,true)) {

          $num=$this->Api_model->get_user_detail($data_array[$i]['mobile_no']);

          $user_data=array(

            "name"=>$num['full_name'],
            "img_url"=>$num['image_url'],
            "mobile_no"=>$num['mobile_no'],
            "token"=>$num['token'],
            "registered"=>TRUE
          );
          array_push($registered_number,$user_data);


        }else{
          $user_data=array(

            "name"=>$data_array[$i]['name'],
            "img_url"=>$data_array[$i]['img_url'],
            "mobile_no"=>$data_array[$i]['mobile_no'],
            "token"=>"",
            "registered"=>FALSE
          );
          array_push($registered_number,$user_data);

        }
     }

     $response['error'] = 0 ;
     $response['message'] = 'List of registered and not registered data';
     $response['data'] = $registered_number;

    }else{
      $response['error'] = 1 ;
      $response['message'] = 'No data';

    }

    echo  json_encode($response);
  }
  public function categoryApi() {
    $lang =  $this->input->post('language');
    $category = $this->Api_model->getcategories($lang);
    //general->get_tbl_data_result('category_name,category_table,category_photo as category_marker,language,summary_list','categories_tbl',array('language'=>$lang));
    $final=array();
    $i=0;
    foreach($category as $data){
      $sum=$this->Api_model->get_sum_name($data['category_table'],$data['summary_list']);
      $sum_name=$sum['nepali_lang'];
      $da=array('summary_name'=>$sum_name);
      //}
      $a=array_merge($category[$i],$da);
      array_push($final,$a);
      $i++;
      }
    $response['status']=0;
    $response['data']=$final;
    echo json_encode($response);
    // echo "<pre>";
    // print_r($response);die;
  }
  public function geojson_test()
  {
    
  }
  public function geojson() {
    $tbl=$_POST['cat_table'];
    // print_r($_POST['cat_table']);die;
    if(!$this->db->table_exists($tbl)){
      $response['msg']='Data table does not exists';
      echo json_encode($response);
    }else{
      $d=$this->Table_model->get_lang($tbl);
      /* get the object   */
      $report = $this->general->get_tbl_data_result('*',$_POST['cat_table'], array('type'=>$_POST['type']));
      // echo"<pre>";print_r($report);die;
      foreach($report as $data){
        $ddata=$data ;
        // unset($data['st_asgeojson']);
        $geometry =array(
          "type"=>"Point",
          "coordinates"=>[
             $data['latitude'],
             $data['longitude']
          ],
        );
        $features_cat[]= array(
          'type' =>'Feature',
          'properties'=>
          [
            'FID'=>$data['id'],
            'Name'=>$data['name'],
            'Type'=>$data['name'],
            'Descrption'=>$data['description'],
            'Primary image'=>$data['primary_image'],
            'Images'=>$data['three_sixty_images'],
            'Videos'=>$data['videos'],
            '360 Image'=>$data['three_sixty_images'],
            'Audio'=>$data['audio'],
            'Language'=>$data['language'],
            'QR Code'=>$data['qr_code'],
            'Latitude'=>$data['latitude'],
            'Longitude'=>$data['longitude'],
            'place type'=>$data['placetype'],
            // 'id'=>$data['id'],
          ],
          "geometry" => $geometry,
        );
      }
      $dataset_array= array(
        'type' => 'FeatureCollection',
        'features' => $features_cat,
      );
      $dataset_geojson=json_encode($dataset_array, JSON_NUMERIC_CHECK);
      echo $dataset_geojson;
    }
  }
  public function starRating()
  {
      $rating = $this->input->post('rating');
      $id = $this->input->post('id');
      $tbl = $this->input->post('category_table');
      $d =array('a0'=>$tbl);
      $report = $this->Table_model->updateRating($id,$d,$tbl);
      if($report){
        $response['error'] = 0 ;
        $response['message'] = 'Thanks For Rating Us';
        $response['message'] = 'Thanks For Rating Us';
        $response['average'] = "4";
      }else{
        $response['error'] = 1 ;
        $response['message'] = 'Unable to rate !';
      }
      echo json_encode($response);
  }
  public function placeRating()
  {
      $rating = $this->input->post('rating');
      $id = $this->input->post('id');
      $d =array('location_id'=>$id);
      $report = $this->Table_model->updatePlcaeRating($id,$d,'locationinformation');
      if($report){
        $kdada=array("rating"=>$report[0]['total']);
        //print_r($kdada);die;
        $trans = $this->Table_model->placeRating($id,$kdada,'locationinformation');
        if($trans){
          $response['error'] = 0;
          $response['message'] = 'Thanks For Rating Us';
          $response['average'] = $report[0]['total'];
        }
      }else{
        $response['error'] = 1;
        $response['message'] = 'Unable to rate !';
      }
      echo json_encode($response);
  }
}//end


            
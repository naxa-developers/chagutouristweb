<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quiz extends Admin_Controller 
{
	function __construct()
	{	
        $this->load->model('quiz_model');
	}
	public function index()
    {
    	$this->data=array();
    	$this->template->set_layout('frontend/default');
    	$lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
        $this->data['category'] = $this->general->get_tbl_data_result('*','quiz_category',false,'sort_order',"DESC");
        //echo "<pre>"; print_r($this->data['category']);die;
		$this->template
			->enable_parser(FALSE)
			->build('frontend/quiz_list', $this->data);
    }
    public function play_quiz($slug)
    {
        $this->data=array();
        $this->template->set_layout('frontend/default');
        $lang=$this->session->get_userdata('Language');
        if($lang['Language']=='en') {
            $emerg_lang='en';
        }else{
            $emerg_lang='nep'; 
        }
        $this->data['cat'] = $this->general->get_tbl_data_result('id,name','quiz_category',array('slug'=>$slug));
        $this->data['category'] = $this->general->get_tbl_data_result('*','quiz',array('cat_id'=>$this->data['cat'][0]['id']));
        //echo "<pre>"; print_r($this->data['cat']);die;
        $this->template
            ->enable_parser(FALSE)
            ->build('frontend/quiz', $this->data);
    }
    public function check_status()
    {
        if($this->input->server('REQUEST_METHOD')=='POST')
        {   $mac = $this->general->get_Mac_Address();
            //print_r($mac);die;
            $questionid = $this->input->post('nqnid');
            $catid = $this->input->post('catid');
            $optionsid = $this->input->post('optionid');
            $questions = $this->general->get_tbl_data_result('*','quiz_options', array('id'=>$optionsid,"category_id"=>$questionid));
            $maxid = $this->general->get_tbl_data_result('max(id) as id','quiz', array('cat_id'=>$catid));
            $quiz = $this->general->get_tbl_data_result('*','quiz', array("id"=>$questionid));
            //print_r($questions[0]['right_answer']);die;
            //print_r($_SERVER['SERVER_ADDR']);print_r( $questionid); print_r($this->input->post());
            // $d = explode('Physical Address. . . . . . . . .',shell_exec ("ipconfig/all"));
            // $d1 = explode(':',$d[1]);
            // $d2 = explode(' ',$d1[1]);

            ob_start(); // Turn on output buffering
            system('ifconfig | grep HWaddr'); //Execute external program to display output
            $mycom=ob_get_contents(); // Capture the output into a variable
            ob_clean(); // Clean the output buffer

            $find_word = "Link encap:Ethernet HWaddr";
            $pmac = strpos($mycom, $find_word); // Find the position of Physical text in array
            $mac=substr($mycom,($pmac+36),27); // Get Physical Addr
            $arr1 = explode(' ',trim($mac));
                //ob_start(); // Turn on output buffering
                //system('ipconfig /all'); //Execute external program to display output
                //$mycom=ob_get_contents(); // Capture the output into a variable
                //ob_clean(); // Clean (erase) the output buffer
                //$findme = "Physical";
                //$pmac = strpos($mycom, $findme); // Find the position of Physical text
                //$macp=substr($mycom,($pmac+36),17); // Get Physical Address
                //print_r($mycom);die;
            //print_r($arr1[1]);die;
            $data_array= array(
                "question_id"=>$questionid,
                "option_id"=>$optionsid,
                "cat_id"=>$catid,
                "mac"=>$arr1[1],
                "ip"=>$_SERVER['SERVER_ADDR'],
                );
            $table="quiz_response";

            $questionsright = $this->general->get_tbl_data_result('*','quiz_response', array('question_id'=>$questionid,'mac'=>$arr1[1]));
            if(empty($questionsright))
            {
                $response = $this->quiz_model->insert_data($table,$data_array);

                if($questions[0]['right_answer'] == "1" || $questions[0]['right_answer'] == "on")
                {
                    $rightanswer = $this->quiz_model->update_data_right_answer($response,array('answer'=>"1"));
                    $count = $this->general->get_tbl_data_result('count(id) as total','quiz_response', array("answer"=>"1"));
                    $wcount = $this->general->get_tbl_data_result('count(id) as total','quiz_response', array("answer"=>"2"));
                    if($maxid[0]['id'] === $questionid)
                    {
                        $trans = $this->quiz_model->wipedata($catid);
                    }
                            // print_r($count[0]['total']);die;
                    $template = $quiz[0]['answer'];
                    $color = "alert-info";
                    print_r(json_encode(array('status'=>'success','result'=>'<div class="alert '.$color.' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong><i class="la la-check-circle la-2x"> </i> </strong> '.$template.'  </div>Total Right<span class="badge badge-secondary">'.$count[0]['total'].' </span> Total Wrong<span class="badge badge-secondary">'.$wcount[0]['total'].' </span>','message'=>'Record Selected Successfully')));
                    exit;
                }else{
                    $rightanswer = $this->quiz_model->update_data_right_answer($response,array('answer'=>"2"));
                    $rcount = $this->general->get_tbl_data_result('count(id) as total','quiz_response', array("answer"=>"1"));
                    $count = $this->general->get_tbl_data_result('count(id) as total','quiz_response', array("answer"=>"2"));
                    if($maxid[0]['id'] === $questionid)
                    {
                        $trans = $this->quiz_model->wipedata($catid);
                    }
                    $template = $quiz[0]['wrong_answer'];
                    $color = "alert-danger";
                    print_r(json_encode(array('status'=>'success','result'=>'<div class="alert '.$color.' alert-dismissible"> <i class="la la-times-circle la-2x"></i>   <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong></strong> '.$template.'  </div>Total Wrong<span class="badge badge-secondary">'.$count[0]['total'].' </span>  Total Right<span class="badge badge-secondary">'.$rcount[0]['total'].' </span>','message'=>'Record Selected Successfully')));
                    exit;
                }
            }else{
                print_r(json_encode(array('status'=>'success','result'=>'<div class="alert alert-danger alert-dismissible"> <i class="la la-times-circle la-2x"></i>   <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong></strong> You can not change your choice for this question  !!  </div>','message'=>'Successfully')));
                exit;
            }
        }else{
            print_r(json_encode(array('status'=>'error','message'=>'Cannot Perform this Operation')));
            exit;
        }
    }
}

 //  F4-30-B9-93-43-71

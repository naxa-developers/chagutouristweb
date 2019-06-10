<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendar extends Admin_Controller 
{
	function __construct()
	{	
        $this->load->model('calendar_mdl');
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
        $this->data['baisak'] = $this->calendar_mdl->datacount("2076-01-01","2076-01-33");
        $this->data['jestha'] = $this->calendar_mdl->datacount("2076-02-01","2076-02-33");
        $this->data['asad'] = $this->calendar_mdl->datacount("2076-03-01","2076-03-33");
        $this->data['sawn'] = $this->calendar_mdl->datacount("2076-04-01","2076-04-33");
        $this->data['bhadra'] = $this->calendar_mdl->datacount("2076-05-01","2076-05-33");
        $this->data['ashoj'] = $this->calendar_mdl->datacount("2076-06-01","2076-06-33");
        $this->data['kartik'] = $this->calendar_mdl->datacount("2076-07-01","2076-07-33");
        $this->data['mangsir'] = $this->calendar_mdl->datacount("2076-08-01","2076-08-33");
        $this->data['poush'] = $this->calendar_mdl->datacount("2076-09-01","2076-09-33");
        $this->data['magh'] = $this->calendar_mdl->datacount("2076-10-01","2076-10-33");
        $this->data['falgun'] = $this->calendar_mdl->datacount("2076-11-01","2076-11-33");
        $this->data['chtira'] = $this->calendar_mdl->datacount("2076-12-01","2076-12-33");

        $this->data['catgegory'] = $this->general->get_tbl_data_result('id,name,slug,description,type','calendar',array('language'=>$emerg_lang));
        //echo "<pre>"; print_r($this->data['baisak']);die;
		$this->template
			->enable_parser(FALSE)
			->build('frontend/calendar', $this->data);
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends CI_Controller {

	public function index()
	{	
		$this->load->model('Issue_model');
		$this->load->helper('url');
		$this->load->helper('text_helper');
		
		$this->load->view('issue_list');
	}
	
	public function issues($last_update = 0)
	{	
		$this->load->model('Issue_model');
		$this->load->helper('url');
		$this->load->helper('text_helper');
		
		$part_order = array( "진행", "검토", "완료", "검수", "보류", "중지" );
		$set_order = array( "검토", "진행", "완료", "검수", "보류", "중지" );
		
		
		$issues = $this->Issue_model->get_issues($last_update);
		
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(array('issues' => &$issues, 'set_order' => &$set_order, 'last_update'=> $_SERVER['REQUEST_TIME'] )));
	}
	
	
	public function toggle_assign($sn, $last_update = 0)
	{
		$this->load->model('Issue_model');
		$this->load->helper('url');
		
		$issue = $this->Issue_model->get_issue($sn, false, false);
		
		if ( strlen($issue['Owner']) == 0 ) // assign owner
		{
			$this->Issue_model->set_issue_owner($sn, '석주');
		}
		else // unasign owner
		{
			$this->Issue_model->set_issue_owner($sn, '');
		}
		
		return $this->issues($last_update);
	}
	
	public function change_status($sn, $last_update)
	{
		$this->load->model('Issue_model');
		$this->load->helper('url');
		
		$this->Issue_model->set_status($sn, urldecode($status));
		
		return $this->issues($last_update);
	}
}

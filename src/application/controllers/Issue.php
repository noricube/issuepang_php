<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends CI_Controller {

	public function index()
	{	
		$this->load->model('Issue_model');
		$this->load->helper('url');
		$this->load->helper('text_helper');
		
		$part_order = array( "진행", "검토", "완료", "검수", "보류", "중지" );
		$set_order = array( "검토", "진행", "완료", "검수", "보류", "중지" );
		
		
		$issue_groups = array();
		
		foreach($part_order as &$i)
		{
			$issue_groups[] = array(
				'Title' => "모든 이슈-$i",
				'Issues' => $this->Issue_model->get_issues_by_status($i)
			);
		}
		
		$this->load->view('issue_list', array('issue_groups' => &$issue_groups, 'set_order' => &$set_order));
	}
	
	public function toggle_assign($sn)
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
		
		redirect('/issue');
	}
	
	public function change_status($sn, $status)
	{
		$this->load->model('Issue_model');
		$this->load->helper('url');
		
		$this->Issue_model->set_status($sn, urldecode($status));
		
		redirect('/issue');
	}
}
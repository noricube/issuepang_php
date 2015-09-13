<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends CI_Controller {

	public function index()
	{	
		$this->load->model('Issue_model');
		
		$part_order = array( "진행", "검토", "완료", "검수", "보류", "중지" );
		
		$issue_groups = array();
		
		foreach($part_order as &$i)
		{
			$issue_groups[] = array(
				'Title' => "모든 이슈-$i",
				'Issues' => $this->Issue_model->get_issues_by_status($i)
			);
		}
		
		$this->load->view('issue_list', array('issue_groups' => &$issue_groups));
	}
}

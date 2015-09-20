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
		
		
		$result = array();
		$result['issues'] = &$issues;
		$result['last_update'] = $_SERVER['REQUEST_TIME'];
		
		if ( $last_update == 0 ) // 시작 요청에서만 보내줌
		{
			$result['part_order'] = &$part_order;
			$result['set_order'] = &$set_order;
		}
		
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result));
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
	
	public function change_status($sn)
	{
		$this->load->model('Issue_model');
		$this->load->helper('url');
		
		$status = urldecode($this->input->post('status'));
		$last_update = $this->input->post('last_update');
		
		$this->Issue_model->set_issue_status($sn, $status);

		return $this->issues($last_update);
	}
	
	public function add_issue()
	{
		$this->load->model('Issue_model');
		$this->load->helper('url');
		
		$title = $this->input->post('issue');
		$status = urldecode($this->input->post('status'));
		$last_update = $this->input->post('last_update');
		
		$this->Issue_model->add_issue($title, $status);
		
		return $this->issues($last_update);
	}
	
	public function edit_issue($sn)
	{
		$this->load->model('Issue_model');
		$this->load->helper('url');
		
		$title = $this->input->post('issue');
		$last_update = $this->input->post('last_update');
		
		$this->Issue_model->set_issue_title($sn, $title);
		
		return $this->issues($last_update);
	}
	
	public function add_comment($sn)
	{
		$this->load->model('Issue_model');
		$this->load->helper('url');
		
		$comment = $this->input->post('comment');
		$last_update = $this->input->post('last_update');
		
		$this->Issue_model->add_issue_comment($sn, $comment);
		
		return $this->issues($last_update);
	}
	
	public function edit_comment($sn_cmt)
	{
		$this->load->model('Issue_model');
		$this->load->helper('url');
		
		$comment = $this->input->post('comment');
		$last_update = $this->input->post('last_update');
		
		$this->Issue_model->set_issue_comment($sn_cmt, $comment);
		
		return $this->issues($last_update);
	}
}

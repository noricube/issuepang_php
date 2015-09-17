<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Issue_model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
		
		public function get_issue($sn, $with_comments = true, $with_tags = true)
		{
			$query = $this->db->from('Issue')->where('SN', $sn)->get();
			
			
			$issue =  $query->row_array();
			
			if ( $with_comments )
			{
				$issue['Comments'] = $this->get_comments($issue['SN']);
			}
			
			if ( $with_tags )
			{
				$issue['Tags'] = $this->get_tags($issue['SN']);
			}
			
			return $issue;
		}
		
		public function get_issues($last_update = 0)
		{
			$date = date("Y-m-d H:m:s", $last_update);

			$query = $this->db->from('Issue')->where('ModifiedTime >=', $date )->get();
			
			$issues = $query->result_array();
			foreach($issues as &$issue)
			{
				$issue['Comments'] = $this->get_comments($issue['SN']);
				$issue['Tags'] = $this->get_tags($issue['SN']);
			}
			
			return $issues;
		}
		
		public function get_comments($sn)
		{
			$query = $this->db->from('Comment')->where('SN', $sn)->get();
			
			return $query->result_array();
		}
		
		public function get_tags($sn)
		{
			$query = $this->db->select('Tag')->from('Tag')->where('SN', $sn)->get();
			
			$tags_results = $query->result_array();
			$tags = array();
			
			foreach($tags_results as &$tag_result)
			{
				$tags[] = $tag_result['Tag'];
			}
			
			return $tags;
		}

		public function set_issue_owner($sn, $owner)
		{
			$this->db->set('Owner', $owner)->set('ModifiedTime', date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']))->where('SN', $sn)->update('Issue');
		}
		
		public function set_issue_title($sn, $title)
		{
			$this->db->set('Issue', $title)->set('ModifiedTime', date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']))->where('SN', $sn)->update('Issue');
		}
		
		public function set_issue_comment($sn_cmt, $comment)
		{
			$query = $this->db->from('Comment')->where('SN_Cmt', $sn_cmt)->get();
			$comment_row = $query->row_array();
			
			$this->db->set('Comment', $comment)->where('SN_Cmt', $sn_cmt)->update('Comment');
			$this->db->set('ModifiedTime', date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']))->where('SN', $comment_row['SN'])->update('Issue');
		}
		
		public function set_status($sn, $status)
		{
			$this->db->set('Status', $status)->set('ModifiedTime', date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']))->where('SN', $sn)->update('Issue');
		}

}
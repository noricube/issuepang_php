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
		
		public function get_issues_by_status($status)
		{
			$query = $this->db->from('Issue')->where('Status', $status)->get();
			
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

}
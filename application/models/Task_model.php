<?php

class Task_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_tasks(){
		$query = $this->db->get('task');
		return $query->result_array();
	}

	public function get_task($taskId){
		$query = $this->db->get_where('task', array('id' => $taskId));
		return $query->result_array();
	}
}
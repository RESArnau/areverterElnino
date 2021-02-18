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

	public function add_task($name,$priority,$description,$color,$date=null){
		
		if ($date == null) {
            $date = date('Y-m-d');
        }
        $data = array('name' => $name, 'priority' => $priority, 'description' => $description, 'color' => $color, 'date' => $date);

		$query= $this->db->insert('task', $data);

        return $query;
		
	}
	public function delete_task($taskId){
		
        $data = array('id' => $taskId);

		$query= $this->db->delete('task', $data);
		
        return $taskId;
		
	}

	public function get_tasks_by_name($name){

		$this->db->like('name', $name);
		$query = $this->db->get('task');

		return $query->result_array();
	}

	public function get_tasks_by_priority($priority){
		
		$query = $this->db->get_where('task', array('priority' => $priority));

		return $query->result_array();
		
	}
}
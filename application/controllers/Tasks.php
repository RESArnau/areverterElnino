<?php

	class Tasks extends CI_Controller{
		public function view($task = 'home'){
			if(!file_exists(APPPATH.'views/tasks/'.$task.'.php')){
				show_404();
			}

			$data['title'] = 'tasks';

			$data['tasks']=$this->task_model->get_tasks();
			print_r($data);
			$this->load->view('templates/header');
			$this->load->view('tasks/'.$task, $data);
			$this->load->view('templates/footer');
		}
	}

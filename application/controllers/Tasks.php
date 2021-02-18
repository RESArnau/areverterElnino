<?php

	class Tasks extends CI_Controller{

		public function show(){
			
			$data['title'] = 'tasks';

			$data['tasks']=$this->task_model->get_tasks();
			
			$this->load->view('templates/header');
			$this->load->view('tasks/task',$data);
			$this->load->view('templates/footer');
		}

		public function add(){
			$this->load->helper(array('form'));		
			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'Nombre', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				redirect('/index.php/tasks/show');
			}else{
				$color=1;
				
				$result = $this->task_model->add_task($_POST['name'],$_POST['priority'],$_POST['description'],$color);
				redirect('/index.php/tasks/show');
			}
			 
		}

		public function delete(){			
			
			$result = $this->task_model->delete_task($_POST['id']);

			if($result){
				echo $result;
			}
			
		}
		public function search(){			
			
			if(!$_POST['name']){
				$_POST['name']="";
			}

			if($_POST['priority']==0){
				$_POST['priority']=null;
			}
			
			$result = $this->task_model->get_tasks_by_name_and_description($_POST['name'],$_POST['priority']);
			
			if($result){
				echo json_encode($result);
			}
			
		}
	}

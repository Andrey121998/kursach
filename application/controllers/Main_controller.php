<?php
class Main_controller extends Controller
{
	protected $db;
	function __construct(){
		$this->model = new Main_model();
		$this->view = new View();
	}
	function action_index(){	
		$data = $this->model->index();
		$this->view->generate('Main_view.php', 'template_view.php', $data);
	}

	function action_deleteTusk() {
    $data = $this->model->deleteTusk();
    $this->view->generate('', 'ajax_view_json.php', $data);
	} 
	
	function action_deleteSubTusk() {
    $data = $this->model->deleteSubTusk();
    $this->view->generate('', 'ajax_view_json.php', $data);   
	}

	function action_updateTuskStatus() {
    $data = $this->model->updateTuskStatus();
    $this->view->generate('', 'ajax_view_json.php', $data);
	}

	function action_updateSubTuskStatus() {
    $data = $this->model->updateSubTuskStatus();
    $this->view->generate('', 'ajax_view_json.php', $data);
	}

  	function action_newTusk() {
		
		$data = $this->model->newTusk();
		$this->view->generate('', 'ajax_view_json.php', $data);
	}

	function action_saveTusk() {
		
		$data = $this->model->saveTusk();
		$this->view->generate('', 'ajax_view_json.php', $data);
	}
}
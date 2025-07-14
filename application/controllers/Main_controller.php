<?php
class Main_controller extends Controller
{
	protected $db;
	function __construct()
	{
		$this->model = new Main_model();
		$this->view = new View();
	}
	function action_index()
	{	
		$data = $this->model->index();
		$this->view->generate('Main_view.php', 'template_view.php', $data);
	}
	function edit() {
    
		$data = $this->model->edit();
		$this->view->generate('KafedraCls/edit_view.php', 'default_view.php', $data);
	  }
	
	function delete() {
		
		$data = $this->model->delete();
		$this->view->generate('', 'ajax_view_json.php', $data);
	  }
	
	function save() {
		
		$data = $this->model->save();
		$this->view->generate('', 'ajax_view_json.php', $data);
	  }
}
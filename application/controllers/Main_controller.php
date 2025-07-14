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
	 public function update_task_status()
{
    $taskId = $_POST['id'] ?? null;
    $status = $_POST['implemented'] ?? null;
    
    if (empty($taskId) || !isset($status)) {
        echo json_encode(['result' => 0, 'message' => 'Неверные параметры']);
        return;
    }
    
    $result = $this->model->update_task_status($taskId, $status);
    
    echo json_encode([
        'result' => $result ? 1 : 0,
        'message' => $result ? '' : 'Ошибка обновления'
    ]);
}

public function update_subtask_status()
{
    $subtaskId = $_POST['id'] ?? null;
    $status = $_POST['implemented'] ?? null;
    
    if (empty($subtaskId) || !isset($status)) {
        echo json_encode(['result' => 0, 'message' => 'Неверные параметры']);
        return;
    }
    
    $result = $this->model->update_subtask_status($subtaskId, $status);
    
    echo json_encode([
        'result' => $result ? 1 : 0,
        'message' => $result ? '' : 'Ошибка обновления'
    ]);
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
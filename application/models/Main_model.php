<?php

class Main_model extends Model

{

	public function index()
	{	
      $sql = 'SELECT 
            t.id,
            t.implemented,
            t.priority,
            t.description,
            s.id as subtask_id,
            s.implemented as sub_implemented,
            s.description as subtask_description,
            s.num
        FROM Tusk t
        LEFT JOIN Subtusk s ON 
            s.tuskId = t.id AND 
            s.actual = true
        WHERE 
            t.actual = true
        ORDER BY 
            t.implemented, 
            t.priority, 
            s.implemented,
            s.num
        ';
    $q = $GLOBALS['pdo']->prepare($sql);
    $q->execute();
    $return['Tusks'] = $q->fetchAll();
    return $return;
  }
     public function update_task_status($taskId, $status)
{
    $sql = "UPDATE Tusk SET implemented = :status WHERE id = :id";
    $q = $GLOBALS['pdo']->prepare($sql);
    $q->bindValue(':status', $status, PDO::PARAM_INT);
    $q->bindValue(':id', $taskId, PDO::PARAM_INT);
    return $q->execute();
}

public function update_subtask_status($subtaskId, $status)
{
    $sql = "UPDATE Subtusk SET implemented = :status WHERE id = :id";
    $q = $GLOBALS['pdo']->prepare($sql);
    $q->bindValue(':status', $status, PDO::PARAM_INT);
    $q->bindValue(':id', $subtaskId, PDO::PARAM_INT);
    return $q->execute();
}

}
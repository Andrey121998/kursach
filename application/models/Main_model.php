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
            s.num
        ';
    $q = $GLOBALS['pdo']->prepare($sql);
    $q->execute();
    $return['Tusks'] = $q->fetchAll();
    return $return;
  }
    

}
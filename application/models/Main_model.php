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
            s.id as subtusk_id,
            s.implemented as sub_implemented,
            s.description as subtusk_description,
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

    function deleteTusk() {


      $sql = 'UPDATE Tusk SET actual=0
                WHERE id=:id';
      $q = $GLOBALS['pdo']->prepare($sql);
      $q->execute(array(
          'id' => $_POST['id']));

      return array('result' => 1);
    }

    function deleteSubTusk() {


      $sql = 'UPDATE Subtusk SET actual=0
                WHERE id=:id';
      $q = $GLOBALS['pdo']->prepare($sql);
      $q->execute(array(
          'id' => $_POST['id']));

      return array('result' => 1);
    }

    public function updateTuskStatus() {

    $sql = 'UPDATE Tusk SET implemented = :implemented WHERE id = :id';
    $q = $GLOBALS['pdo']->prepare($sql);
    $q->execute(array(
        'id' => $_POST['id'],
        'implemented' => $_POST['implemented']
    ));
    
    return array('result' => 1);
    }
    
    public function updateSubTuskStatus() {

    $sql = 'UPDATE Subtusk SET implemented = :implemented WHERE id = :id';
    $q = $GLOBALS['pdo']->prepare($sql);
    $q->execute(array(
        'id' => $_POST['id'],
        'implemented' => $_POST['implemented']
    ));
    
    return array('result' => 1);
    }
    
    public function newTusk() {
    $return = array();
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
     if (empty($id)) {
      $return['Tusk'] = array(
        'id' => '',
        'priority' => '',
        'description' => '',
      );
     } else {
      $sql = 'SELECT id, priority, description FROM Tusk WHERE id = :id';
      $q =  $GLOBALS['pdo']->prepare($sql);
      $q->execute(array('id' => $id));
      $return['Tusk'] = $q->fetch();
     }
     return $return;
  }
  
  
  
  public function saveTusk() {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $priority = isset($_POST['priority']) ? (int)$_POST['priority'] : 0;
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    if (empty($id)) {
        // Добавление новой записи
        $sql = 'INSERT INTO Tusk (
                    priority,
                    description
                ) VALUES (
                    :priority,
                    :description
                )';

        $q = $GLOBALS['pdo']->prepare($sql);
        $execute = $q->execute(array(
            'priority' => $priority,
            'description' => $description
        ));

        if (!$execute) {
            return array('result' => 0);
        }

        $id = $GLOBALS['pdo']->lastInsertId();
    }

    // Обновление существующей записи
    $sql = 'UPDATE Tusk SET 
                priority = :priority,
                description = :description
            WHERE id = :id';

    $q = $GLOBALS['pdo']->prepare($sql);
    $execute = $q->execute(array(
        'id' => $id,
        'priority' => $priority,
        'description' => $description
    ));

    return array('result' => $execute ? 1 : 0);
}
  
    

}
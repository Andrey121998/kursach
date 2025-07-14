<?php 
//sys::js('Contract.js');
//phpinfo(); ?>  
<h2 class="row g-3">To Do list</h2>  
<p>
        Список ваших задач:
  </p>
  <?php
  //var_dump($data);
   ?>
<ul class="task-list">
    <?php if (!empty($data['Tusks'])): // Проверяем, есть ли задачи ?>
        <?php
        $currentTaskId = null; // Переменная для отслеживания текущей задачи
        $countT = 0;
        $countS = 0;
        foreach ($data['Tusks'] as $row) {
            // Если это новая задача, выводим её
            if ($currentTaskId !== $row['id']) {
              $countT++;
              //$countS++;
                if ($currentTaskId !== null) {
                    // Закрываем предыдущий список подзадач, если он был открыт
                    echo '</ul>';
                }

                // Обновляем текущую задачу
                $currentTaskId = $row['id'];

                // Выводим задачу
                echo '<li>';
                echo '<div class="task-header">';
                echo '<input type="checkbox" class="complete-task" data-id="' . $row['id'] . '" title="Выполнено" ' . ($row['implemented'] ? 'checked' : '') . '>';
                echo '<button class="edit-task" data-id="' . $row['id'] . '" title="Редактировать">✏️</button>';
                echo '<button class="delete-task" data-id="' . $row['id'] . '" title="Удалить">❌</button>';
                echo '<strong>Задача #' . $countT . '</strong> - Приоритет: ' . $row['priority'] . '<br>';
                echo '</div>';
                echo '<div class="task-description">' . $row['description'] . '</div>';
                
                echo '<ul class="subtask-list">'; // Открываем список подзадач
            }

            // Если есть подзадача, выводим её
            if ($row['subtask_description']) {
                echo '<li>';
                echo '<div class="subtask-header">';
                echo '<input type="checkbox" class="complete-subtask" data-id="' . $row['subtask_id'] . '" title="Выполнено" ' . ($row['sub_implemented'] ? 'checked' : '') . '>';
                echo '<button class="edit-subtask" data-id="' . $row['subtask_id'] . '" title="Редактировать">✏️</button>';
                echo '<button class="delete-subtask" data-id="' . $row['subtask_id'] . '" title="Удалить">❌</button>';
                echo  ' Номер: ' . $row['num']. '<br>';
                echo '</div>';
                echo '<div class="subtask_descriptionn">' . $row['subtask_description'] . '</div>';
                echo '</li>';
            }
        }

        // Закрываем последний список подзадач, если он был открыт
        if ($currentTaskId !== null) {
            echo '</ul>'; // Закрываем список подзадач
            echo '</li>'; // Закрываем последнюю задачу
        }
        ?>
    <?php else: // Если задач нет ?>
        <li>Задач пока нет.</li>
    <?php endif; ?>
</ul>

<!-- Кнопка для добавления новой задачи -->
<button class="add-task">➕ Добавить задачу</button>
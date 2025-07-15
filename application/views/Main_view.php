 
<h2 >To Do list</h2>  
<p>
        Список ваших задач:
  </p>
  <?php
  //var_dump($data);
   ?>
<ul class="tusk-list">
    <?php if (!empty($data['Tusks'])): // Проверяем, есть ли задачи ?>
        <?php
        $currentTuskId = null; // Переменная для отслеживания текущей задачи
        $countT = 0;
        $countS = 0;
        foreach ($data['Tusks'] as $row) {
            // Если это новая задача, выводим её
            if ($currentTuskId !== $row['id']) {
              $countT++;
              //$countS++;
                if ($currentTuskId !== null) {
                    // Закрываем предыдущий список подзадач, если он был открыт
                    echo '</ul>';
                }

                // Обновляем текущую задачу
                $currentTuskId = $row['id'];

                // Выводим задачу
                echo '<li>';
                echo '<div class="tusk-header" data-id="' . $row['id'] . '">';
                echo '<input type="checkbox" class="complete-tusk" data-id=" ' . $row['id'] . '" title="Выполнено" ' . ($row['implemented'] ? 'checked' : '') . ' >';
                echo '<button class="edit-tusk" data-id="' . $row['id'] . '"onclick="editTusk(' . $row['id'] . ')" data-bs-toggle="modal" data-bs-target="#editTuskModal"  title="Редактировать">✏️</button>';
                echo '<button class="delete-tusk" data-id="' . $row['id'] . '" title="Удалить">❌</button>';
                echo '<strong>Задача #' . $countT . '</strong> - Приоритет: ' . $row['priority'] . '<br>';
                echo '</div>';
                echo '<div class="tusk-description">Описание: ' . $row['description'] . '</div>';
                
                echo '<ul class="subtusk-list">'; // Открываем список подзадач
            }

            // Если есть подзадача, выводим её
            if ($row['subtusk_description']) {
                echo '<li>';
                echo '<div class="subtusk-header">';
                echo '<input type="checkbox" class="complete-subtusk" data-id=" ' . $row['subtusk_id'] . '" title="Выполнено" ' . ($row['sub_implemented'] ? 'checked' : '') . ' >';
                echo '<button class="edit-subtusk" data-id="' . $row['subtusk_id'] . '" title="Редактировать">✏️</button>';
                echo '<button class="delete-subtusk" data-id="' . $row['subtusk_id'] . '" title="Удалить">❌</button>';
                echo  ' Номер: ' . $row['num']. '<br>';
                echo '</div>';
                echo '<div class="subtusk_description">Описание: ' . $row['subtusk_description'] . '</div>';
                echo '</li>';
            }
             echo '<button class="add-subtusk"  title="Добавить подзадачу" style="font-size: 12px; color: green; background: none; border: none; cursor: pointer;">➕</button>';
        }

        // Закрываем последний список подзадач, если он был открыт
        if ($currentTuskId !== null) {
            echo '</ul>'; // Закрываем список подзадач
            echo '</li>'; // Закрываем последнюю задачу
        }
        ?>
    <?php else: // Если задач нет ?>
        <li>Задач пока нет.</li>
    <?php endif; ?>
</ul>


<button type="button" data-bs-toggle="modal" onclick="editTusk(0)" data-bs-target="#editTuskModal" class="btn btn-primary col-md-2">➕ Добавить задачу</button>

 <div class="modal fade bd-example-modal-lg" id="editTuskModal" tabindex="-1" aria-labelledby="editTuskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Заказчик</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form class="row g-2 needs-validation-customer" novalidate="">
              <div class="row g-2">
                  <div class="col-md-6">
                    <label for="priority" class="form-label required">Приоритет</label>
                    <input class="form-control" id="priority" type="text" pattern="[0-9]*" required>
                    <div class="invalid-feedback">
                      Введите значение
                    </div>
                  </div>
                  <div class="col-md-6 ml-auto">
                    <label for="description" class="form-label required">Описание</label>
                    <input class="form-control" id="description" required>
                    <div class="invalid-feedback">
                      Введите значение
                    </div>
                  </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
              <button id="btSaveTusk" type="button" class="btn btn-primary">Сохранить</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
            </div>
          </div>
        </div>
      </div>



      
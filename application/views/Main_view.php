<h2 >To Do list</h2>  
<p>
        Список ваших задач:
  </p>
  <?php
  //var_dump($data);
   ?>
<ul class="task-list">
    <?php if (!empty($data['Tusks'])): ?>
        <?php
        $currentTaskId = null;
        $countT = 0;
        foreach ($data['Tusks'] as $row) {
            if ($currentTaskId !== $row['id']) {
                $countT++;
                if ($currentTaskId !== null) {
                    echo '</ul></li>';
                }
                $currentTaskId = $row['id'];
                ?>
                <li data-id="<?= $row['id'] ?>" class="<?= $row['implemented'] ? 'task-completed' : '' ?>">
                    <div class="task-header">
                        <input type="checkbox" class="complete-task" data-id="<?= $row['id'] ?>" title="Выполнено" <?= $row['implemented'] ? 'checked' : '' ?>>
                        <button class="edit-task" data-id="<?= $row['id'] ?>" title="Редактировать">✏️</button>
                        <button class="delete-task" data-id="<?= $row['id'] ?>" title="Удалить">❌</button>
                        <span class="task-title <?= $row['implemented'] ? 'completed' : '' ?>">
                            <strong>Задача #<?= $countT ?></strong> - Приоритет: <?= $row['priority'] ?>
                        </span>
                    </div>
                    <div class="task-description <?= $row['implemented'] ? 'completed' : '' ?>"><?= $row['description'] ?></div>
                    <ul class="subtask-list">
                <?php
            }

            if ($row['subtask_description']) {
                ?>
                <li data-id="<?= $row['subtask_id'] ?>" class="<?= $row['sub_implemented'] ? 'subtask-completed' : '' ?>">
                    <div class="subtask-header">
                        <input type="checkbox" class="complete-subtask" data-id="<?= $row['subtask_id'] ?>" data-task-id="<?= $row['id'] ?>" title="Выполнено" <?= $row['sub_implemented'] ? 'checked' : '' ?>>
                        <button class="edit-subtask" data-id="<?= $row['subtask_id'] ?>" title="Редактировать">✏️</button>
                        <button class="delete-subtask" data-id="<?= $row['subtask_id'] ?>" title="Удалить">❌</button>
                        <span class="subtask-title <?= $row['sub_implemented'] ? 'completed' : '' ?>">
                            Номер: <?= $row['num'] ?>
                        </span>
                    </div>
                    <div class="subtask-description <?= $row['sub_implemented'] ? 'completed' : '' ?>"><?= $row['subtask_description'] ?></div>
                </li>
                <?php
            }
        }
        if ($currentTaskId !== null) {
            echo '</ul></li>';
        }
        ?>
    <?php else: ?>
        <li>Задач пока нет.</li>
    <?php endif; ?>
</ul>

<!-- Кнопка для добавления новой задачи -->
<button class="add-task">➕ Добавить задачу</button>
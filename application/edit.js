$(function () {
    // Обработка изменения статуса задачи
    $(document).on('change', '.complete-task', function () {
        var taskId = $(this).data('id');
        var isCompleted = $(this).is(':checked') ? 1 : 0;
        var taskElement = $(this).closest('li');

        // Визуальное обновление
        taskElement.toggleClass('task-completed', isCompleted);
        taskElement.find('.task-title, .task-description').toggleClass('completed', isCompleted);

        $.ajax({
            url: "/Main/update_task_status",
            data: {
                id: taskId,
                implemented: isCompleted
            },
            type: "POST",
            success: function (result) {
                if (result.result != '1') {
                    // Откатываем изменения если ошибка
                    taskElement.toggleClass('task-completed');
                    taskElement.find('.task-title, .task-description').toggleClass('completed');
                    Message('Ошибка обновления. ' + (result.message || ''), 'danger');
                }
            },
            error: function () {
                taskElement.toggleClass('task-completed');
                taskElement.find('.task-title, .task-description').toggleClass('completed');
                Message('Ошибка соединения', 'danger');
            }
        });
    });

    // Обработка изменения статуса подзадачи
    $(document).on('change', '.complete-subtask', function () {
        var subtaskId = $(this).data('id');
        var taskId = $(this).data('task-id');
        var isCompleted = $(this).is(':checked') ? 1 : 0;
        var subtaskElement = $(this).closest('li');

        // Визуальное обновление
        subtaskElement.toggleClass('subtask-completed', isCompleted);
        subtaskElement.find('.subtask-title, .subtask-description').toggleClass('completed', isCompleted);

        $.ajax({
            url: "/Main/update_subtask_status",
            data: {
                id: subtaskId,
                implemented: isCompleted
            },
            type: "POST",
            success: function (result) {
                if (result.result != '1') {
                    subtaskElement.toggleClass('subtask-completed');
                    subtaskElement.find('.subtask-title, .subtask-description').toggleClass('completed');
                    Message('Ошибка обновления подзадачи. ' + (result.message || ''), 'danger');
                }
            },
            error: function () {
                subtaskElement.toggleClass('subtask-completed');
                subtaskElement.find('.subtask-title, .subtask-description').toggleClass('completed');
                Message('Ошибка соединения', 'danger');
            }
        });
    });
});

function Message(text, type = 'success') {
    var alertClass = type === 'danger' ? 'alert-danger' : 'alert-success';
    var messageHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                      text +
                      '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                      '</div>';

    $('.alert-messages').html(messageHtml);
    
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
}
$(function () {
    $('button.delete-tusk').click(function () {
      let id = $(this).attr('data-id');
      //console.log(id)
      $.ajax({
        url: "/Main/deleteTusk",
        data: {
          id: id
        },
        type: "POST",
        dataType: 'json',
        success: function (result) {
          if (result.result == '1') {
            location.reload();
          } else {
            var message = result.message || '';
            alert('Ошибка удаления. ' + message, 'danger');
          }
        }
    });
    return false;
  });
   $('button.delete-subtusk').click(function () {
      let id = $(this).attr('data-id');
      //console.log(id)
      $.ajax({
        url: "/Main/deleteSubTusk",
        data: {
          id: id
        },
        type: "POST",
        dataType: 'json',
        success: function (result) {
          if (result.result == '1') {
            location.reload();
          } else {
            var message = result.message || '';
            alert('Ошибка удаления. ' + message, 'danger');
          }
        }
    });
    return false;
  });
  $('.complete-tusk').change(function() {
    let id = $(this).data('id');
    let implemented = this.checked ? 1 : 0;
    
    $.ajax({
        url: "/Main/updateTuskStatus",
        data: {
            id: id,
            implemented: implemented
        },
        type: "POST",
        dataType: 'json',
        success: function(result) {
            if (result.result == '1') {
                location.reload();
            } else {
                var message = result.message || '';
                alert('Ошибка обновления. ' + message, 'danger');
            }
        }
    });
  });
  $('.complete-subtusk').change(function() {
    let id = $(this).data('id');
    let implemented = this.checked ? 1 : 0;
    
    $.ajax({
        url: "/Main/updateSubTuskStatus",
        data: {
            id: id,
            implemented: implemented
        },
        type: "POST",
        dataType: 'json',
        success: function(result) {
            if (result.result == '1') {
                location.reload();
            } else {
                var message = result.message || '';
                alert('Ошибка обновления. ' + message, 'danger');
            }
        }
    });
  });

  $('#btSaveTusk').click(function () {
    let btn = $(this)[0];

    var id = $(this).val();


    $.ajax({
      url: "/Main/saveTusk",
      data: {
        id: id
        ,priority: $('#priority').val()
        ,description: $('#description').val()
      },
      type: "POST",
      success: function (result) {
        if (result.result == '1') {
          alert('Сохранено');
          location.reload();
        } else {
          buttonEnable(btn);
          var message = result.message || '';
          alert('Ошибка сохранения. ' + message, 'danger');
        }
      }
    });

    return false;
  });

   $('#btSaveSubTusk').click(function () {
    let btn = $(this)[0];

    var id = $(this).val();

    console.log(id,  $('#num').val(), $('#tuskId').val(),  $('#subtusk_description').val()  )
    $.ajax({
      url: "/Main/saveSubTusk",
      data: {
        id: id
        ,num: $('#num').val()
        ,tuskId: $('#tuskId').val()
        ,description: $('#subtusk_description').val()
      },
      type: "POST",
      success: function (result) {
        if (result.result == '1') {
          alert('Сохранено');
          location.reload();
        } else {
          buttonEnable(btn);
          var message = result.message || '';
          alert('Ошибка сохранения. ' + message, 'danger');
        }
      }
    });

    return false;
  });

  $(document).on('click', '.edit-btn', function() {
    const id = $(this).data('id');
    
    // Загружаем данные через AJAX POST
    $.ajax({
        url: "/Main/newTusk",
        type: "POST",
        data: { 
            id: id,

        },
        dataType: "json",
        success: function(result) {
            $('#priority').val(result.Tusk.priority);
            $('#description').val(result.Tusk.description);
            $('#editTuskModal').modal('show');
        },
        error: function(xhr) {
            console.error("Ошибка:", xhr.responseText);
            alert('Ошибка загрузки данных: ' + xhr.status);
        }
    });



  //подзадача
  $(document).on('click', '.subEdit-btn', function() {
      const id = $(this).data('id');
      console.log(id,  $('#num').val(), $('#tuskId').val(),  $('#subtusk_description').val()  )
      // Загружаем данные через AJAX POST
      $.ajax({
          url: "/Main/newSubTusk",
          type: "POST",
          data: { 
              id: id,

          },
          dataType: "json",
          success: function(result) {
              $('#num').val(result.Subtusk.num);
              $('#tuskId').val(result.Subtusk.tuskId);
              $('#subtusk_description').val(result.Subtusk.description);
              $('#editSubTuskModal').modal('show');
          },
          error: function(xhr) {
              console.error("Ошибка:", xhr.responseText);
              alert('Ошибка загрузки данных: ' + xhr.status);
          }
      });
  });
});

});
  function editTusk(id){
  $.ajax({
    url: "/Main/newTusk",
    data: {
      id: id
    },
    type: "POST",
    dataType: "json",
    success: function (result) {

      $('#priority').val(result.Tusk.priority);
      $('#description').val(result.Tusk.description);
      $('#editTuskModal').modal('show');
        },
    error: function (result) {
      
    },
  });
}

function editSubTusk(id){
  console.log(id,  $('#num').val(), $('#tuskId').val(),  $('#subtusk_description').val()  )
  $.ajax({
    url: "/Main/newSubTusk",
    data: {
      id: id
    },
    type: "POST",
    dataType: "json",
    success: function (result) {
      $('#tuskId ').val(result.Subtusk.tuskId ); 
      $('#num').val(result.Subtusk.num);
      $('#subtusk_description').val(result.Subtusk.description);
      $('#editSubTuskModal').modal('show');
        },
    error: function (result) {
      
    },
  });
}


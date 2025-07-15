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

});
  function editTusk(id){
  $.ajax({
    url: "/Main/newTusk",
    data: {
      id: id
    },
    type: "GET",
    dataType: "json",
    success: function (result) {

      $('#priority').val(result.Tusk.priority);
      $('#description').val(result.Tusk.description);
    },
    error: function (result) {
      
    },
  });
}

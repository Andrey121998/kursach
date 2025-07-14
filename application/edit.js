$(function () {

    $('table td a.remove').click(function () {
  
      var kafedraId = $(this).closest('tr').attr('data-id');
      var name = $(this).closest('tr').attr('data-name');
  
      Confirm('Удалить <i>' + name + '</i> ?', function () {
        $.ajax({
          url: ModulUrl + "/delete",
          data: {kafedraId: kafedraId},
          type: "POST",
          success: function (result) {
            if (result.result == '1') {
              location.href = "/" + ModulUrl;
            } else {
              var message = result.message || '';
              Message('Ошибка удаления. ' + message, 'danger');
            }
          }
        });
      });
      return false;
    });
  
    $('.save').click(function () {
      let btn = $(this)[0];
  
      document.querySelector('.needs-validation').classList.add('was-validated');
  
      if (!document.querySelector('#name').checkValidity()
              ) {
        return false;
      }
  
      buttonDisable(btn);
  
      var kafedraId = $(this).attr('data-id');
  
      $.ajax({
        url: "/" + ModulUrl + "/save",
        data: {
          kafedraId: kafedraId
          , name: $('#name').val()
          , aname: $('#aname').val()
          , id: $('#id').val()
        },
        type: "POST",
        success: function (result) {
          if (result.result == '1') {
            Message('Сохранено');
            location.href = "/" + ModulUrl;
          } else {
            buttonEnable(btn);
            var message = result.message || '';
            Message('Ошибка сохранения. ' + message, 'danger');
          }
        }
      });
  
      return false;
    });
  
  });
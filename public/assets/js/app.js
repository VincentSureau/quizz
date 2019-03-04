var app = {

  init: function () {
    $('#form').on('submit', app.formSubmit);
    $('.show').click(app.formShow);
    $('.cancel').click(app.cancelForm);
    $('.delete-link').click(app.delete);
    $('.edit-link').click(app.edit);
  },

  formSubmit: function (event) {

    event.preventDefault();
    var url = event.target.getAttribute('action');
    var formData = $(this).serialize();

    $.ajax({
      url: url,
      method: 'POST',
      dataType: 'json',
      data: formData,
    }).done(function (data) {
      $("#alerts").addClass('d-none');
      console.log(data);
      if (data.code == 2) {

        var alertDiv = $("#alerts");
        console.log(alertDiv);

        alertDiv.empty();

        alertDiv.append($('<ul></ul>').attr('id', 'errorList').addClass('mb-0').addClass('pl-3'));
        $.each(data.errorList, function (index, value) {
          $('#errorList').append($('<li></li>').append(value + '<br>'));
        });

        alertDiv.addClass('text-danger').addClass('bg-danger').removeClass('d-none');

      } else {

        var alertDiv = $("#alerts");

        alertDiv.removeClass('bg-danger').addClass('bg-success').addClass('text-center').html(data.succesMessage);

        alertDiv.removeClass('d-none');

        window.setTimeout(function () {
          location.href = data.redirect
        }, 2000);

      }
    });
  },

  formShow : function() {
      $(this).addClass('d-none');
      $("form").removeClass('d-none');
  },

  cancelForm: function() {
    $(this).parent().parent().trigger("reset").addClass('d-none');
    $('.show').removeClass('d-none');
  },

  delete: function() {
    event.preventDefault();
    url = $(this).attr('href');
    console.log(url);
    domElt = $(this);

    $.ajax({
      url: url,
      method: 'POST',
      dataType: 'json',
    }).done(function (data) {
      console.log(data);
      if (data.code == 2) {
      } else {
        domElt.parent().parent().parent().remove();
      }
    });
  }

};

$(app.init);
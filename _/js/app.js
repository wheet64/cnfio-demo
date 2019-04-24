$(function () {
  if (uid === undefined)
    $('#identification').show();
  else
    $('#question_grp').show();
  $('#auth').submit(function (e) {
    $.ajax({
      type: "POST",
      url: './auth/',
      data: $(this).serialize(),
      success: function ($data) {
        // Should be doing some things here...
      },
      dataType: 'json'
    });
    $('#question').val('');
    if ($('#email').is(':visible')) {
      $('#identification').hide();
      $('#question_grp').show();
      $('#question').focus();
    }
    else {
      $('#askQuestion').removeClass('show');
    }
    e.preventDefault();
  });
  firebase.database().ref('session1').on('value', function(snapshot) {
    $('#questions').empty();
    snapshot.forEach(function (i) {
      $('#questions').append($('<li />', {class: 'list-group-item'}).text(i.key));
    });
  });
});

$(function () {
  if (typeof uid === 'undefined')
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
      $('#mod_nav').show();
      $('#question').focus();
    }
    else {
      $('#askQuestion').removeClass('show');
    }
    e.preventDefault();
  });
  firebase.database().ref('session1').orderByChild('vote_count').on('value', function(snapshot) {
    $('#questions').empty();
    snapshot.forEach(function (i) {
      var votes = i.hasChild('vote_count') ? i.child('vote_count').val() : 0;
      $('#questions').prepend($('<li />', {class: 'list-group-item flexli'}).text(i.key).prepend($('<a />', {class: 'vote', href: '#'}).text(votes).click(function () {
        $(this).unbind('click').click(function () { return false; });
        $.ajax({
          type: "POST",
          url: './vote/',
          data: 'q='+encodeURIComponent(i.key),
          success: function ($data) {
            // Should be doing some things here...
          },
          dataType: 'json'
        });
        return false;
      })).append($('<a />', {class: 'delete'+(typeof access_mod === 'undefined' ? ' d-none' : ''), href: '#'}).text('x').click(function () {
        // This element needs the word ":"delete" hidden for accessibility, "x" should be CSS
        $(this).unbind('click').click(function () { return false; });
        $.ajax({
          type: "POST",
          url: './vote/',
          data: 'd='+encodeURIComponent(i.key),
          success: function ($data) {
            // Should be doing some things here...
          },
          dataType: 'json'
        });
        return false;
      })));
    });
  });
});

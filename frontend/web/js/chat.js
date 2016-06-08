$( document ).ready(function() {

    var socket = io.connect('http://localhost:8890');

    socket.on('chat', function (data) {

        var message = JSON.parse(data);

        if(message.me == $('#me').val()) {
            var html = '<div class="bubble me">'+message.message+'</div>';
        } else {
            var html = '<div class="bubble you">'+message.message+'</div>';
        }
        $('.chat[data-chat = "'+message.channel+'"]').append(html);

    });

});
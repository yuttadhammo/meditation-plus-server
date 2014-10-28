// caching elements
var $messages     = $('.messages');
var $sessions     = $('.sessions');
var $chatForm     = $('#chatForm');
var $sessionForm  = $('#sessionForm');
var $messageField = $('#messageField');

var updateChat = function() {
    var atBottom = $messages.scrollTop() + $messages.innerHeight() >= $messages[0].scrollHeight;
    $messages.load(renderChatPath, null, function() {
        var objDiv = document.getElementById("your_div");

        if (atBottom) {
            $messages.scrollTop($messages[0].scrollHeight);
        }
    });
    window.setTimeout(updateChat, 5000);
};

var updateSessions = function() {
    $sessions.load(renderSessionsPath);
    window.setTimeout(updateSessions, 5000);
};

updateSessions();
updateChat();

// submit handler for shoutbox
$chatForm.on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: postMessagePath,
        data: $chatForm.serialize(),
        success: function(data) {
            if (data.status !== 'ok') {
                showError();
                return;
            }
            updateChat();
            $messageField.val('');
        },
        error: showError
    });
});

// submit handler for meditation submission
$sessionForm.on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: postSessionPath,
        data: $sessionForm.serialize(),
        success: function(data) {
            if (data.status !== 'ok') {
                showError();
                return;
            }
            updateSessions();
            $sessionForm.find('input[type=text]').val('');
        },
        error: showError
    });
});

var showError = function() {
    sweetAlert("Oops...", "Something went wrong! Try again later.", "error");
};
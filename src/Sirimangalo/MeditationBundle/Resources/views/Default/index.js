// caching elements
var $messages        = $('.messages');
var $sessions        = $('.sessions');
var $chatForm        = $('#chatForm');
var $sessionForm     = $('#sessionForm');
var $messageField    = $('#messageField');
var $meditationHours = $('#meditationHours');

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

// Charting

var ctx = $meditationHours.get(0).getContext("2d");
var chartData = {
    labels: [
        "00", "01", "02", "03", "04", "05", "06",
        "07", "08", "09", "10", "11", "12", "13",
        "14", "15", "16", "17", "18", "19", "20",
        "21", "22", "23"
    ],
    datasets: [{
            data: meditationHours
        }
    ]
};
var width = $meditationHours.parent().width();
$meditationHours.attr("width", width);
new Chart(ctx).Bar(chartData);

// Redraw on resize
window.onresize = function(event) {
    var width = $meditationHours.parent().width();
    $meditationHours.attr("width", width);
    new Chart(ctx).Bar(chartData);
};
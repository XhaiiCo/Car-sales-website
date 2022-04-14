
function displayFeedback(idContainer, feedback) {
    div = document.createElement('div');
    if (feedback.error === 1) {
        $(div).addClass("alert alert-danger");
        $(div).html(feedback.em)
    } else if (feedback.success === 1) {
        $(div).addClass("alert alert-success");
        $(div).html(feedback.sm)
    }
    $("#" + idContainer).html(div);
}
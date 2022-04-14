
function displayFeedback(idContainer, feedback) {
    if (feedback.error === 1) {
        divError = document.createElement("div");
        $(divError).addClass("alert alert-danger");
        $(divError).html(feedback.em)
        $("#" + idContainer).html(divError);
    } else if (feedback.success === 1) {
        divSuccess = document.createElement("div");
        $(divSuccess).addClass("alert alert-success");
        $(divSuccess).html(feedback.sm)
        $("#" + idContainer).html(divSuccess);
    }
}
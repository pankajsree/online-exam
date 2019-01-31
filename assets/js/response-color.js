function changeColor(ques_serial, selected_opt) {
    var circle_id = "#ques-sl-btn-" + ques_serial;
    switch (selected_opt) {
        case 1:
        case 2:
        case 3:
        case 4:
            $(circle_id).attr("class", "ques-sl-btn sl-answered");
            break;
        case 6:
            $(circle_id).attr("class", "ques-sl-btn sl-marked-re");
            break;
        case -1:
        case -2:
        case -3:
        case -4:
            $(circle_id).attr("class", "ques-sl-btn sl-ans-marked-re");
            break;
        default:
            $(circle_id).attr("class", "ques-sl-btn sl-not-answered");
            break;
    }
}

function responseCount() {
    var count_nv = $('.sl-not-visited').length;
    var count_na = $('.sl-not-answered').length;
    var count_a = $('.sl-answered').length;
    var count_rn = $('.sl-marked-re').length;
    var count_sr = $('.sl-ans-marked-re').length;

    $("#not-visited").text(count_nv);
    $("#not-answered").text(count_na);
    $("#answered").text(count_a);
    $("#marked-re").text(count_rn);
    $("#ans-marked-re").text(count_sr);
}

function totalAnswered() {
    // submit count
    var s_c_a = $('.sl-answered').length;
    var s_c_sr = $('.sl-ans-marked-re').length;

    return (s_c_a + s_c_sr);
}

function summary() {
    var count_nv = $('.sl-not-visited').length;
    var count_na = $('.sl-not-answered').length;
    var count_a = $('.sl-answered').length;
    var count_rn = $('.sl-marked-re').length;
    var count_sr = $('.sl-ans-marked-re').length;

    $("#summary-nv").text(count_nv);
    $("#summary-na").text(count_na);
    $("#summary-a").text(count_a);
    $("#summary-rn").text(count_rn);
    $("#summary-sr").text(count_sr);
}

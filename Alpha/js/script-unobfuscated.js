// click on the div
var bgChg = false;

function toggle(e, id) {
    var el = document.getElementById(id);
    $(el).fadeOut("slow");
    // el.style.display = (el.style.display == 'none') ? 'block' : 'none';

    // save it for hiding
    toggle.el = el;
    setTimeout(function () {
        var elem = document.getElementById('email-container')
        $(elem).fadeIn("slow");
    }, 1000);
    // stop the event right here
    if (e.stopPropagation)
        e.stopPropagation();
    e.cancelBubble = true;
    return false;
}
// click outside the div
document.onclick = function () {
    if (toggle.el) {
        toggle.el.style.display = 'none';
    }
}

$(function () {
    var a = function () {
        var b = $(window).scrollTop();
        var d = $("#navigationBar-anchor").offset().top;
        var c = $("#navigationBar");
        if (b > d) {
            c.css({
                position: "fixed",
                top: "0px"
            })
        } else {
            c.css({
                position: "absolute",
                top: ""
            })
        }
    };
    $(window).scroll(a);
    a()
});

function thebackground() {

    setInterval('change()', 7000);
}

function change() {
    if (bgChg) {
        $('div.macbook img').fadeIn(1000);
        $('div.macbook img:first').fadeOut(1000);
        bgChg = false;
    } else {
        $('div.macbook img').fadeOut(1000);
        $('div.macbook img:first').fadeIn(1000);
        bgChg = true;
    }
};
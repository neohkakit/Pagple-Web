// click on the div

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

$(document).ready(function () {
    $("#email-form").submit(function (e) {
        e.preventDefault(); // stop from summiting normally

        var form = $(this),
            email = form.find('input[name="email-field"]').val(),
            url = form.attr('action');

        $.post(url, {
            "email-field": email
        }, function (data) {
            var atpos = email.indexOf("@");
            var dotpos = email.lastIndexOf(".");

            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
                $("#email-background").effect("shake", {
                    times: 3
                }, 800);
                $("#email-background").css("box-shadow", "0 0 16px #E24549");
            } else {
                $("#email-container").empty().append(data);
                $("#email-container").toggleClass("animateMargin");
                $("#email-container").animate({
                    marginLeft: '+=' + ($(document).width() - 550) / 2,
                }, 300, function () {
                    // Animation complete. [callback function]
                    $("#email-container").css('margin', '0 auto');

                });
            }
        });
    });
}); // end document.ready()
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
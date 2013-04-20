//
//    pa.js
//    Pagple
//
//    Created by Matthias Ryne Cheow on 05/03/13.
//

$(function() {
    $('label .field input').focus(function() {
        $(this).closest('label').addClass('focus');
    });
    $('label .field input').blur(function() {
        $(this).closest('label').removeClass('focus');
    });
    $('label .field input').keyup(function() {
        var hasContent = !((/$\s*^/).test($(this).val()));
        $(this).closest('label').toggleClass('has-content', hasContent);
    });
});
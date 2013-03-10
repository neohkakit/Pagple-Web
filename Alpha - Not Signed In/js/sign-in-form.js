$(function () {
   var username = $("#username"),
      email = $("#email"),
      fields = $([]).add(username).add(email),
      tips = $(".validateTips");

   function updateTips(t) {
      tips.text(t).addClass("ui-state-highlight");

      setTimeout(function () {
         tips.removeClass("ui-state-highlight", 1500);
      }, 500);
   }

   function checkLength(text, object, min, max) {
      if (text.val().length > max || text.val().length < min) {
         text.addClass("ui-state-error");
         updateTips("Length of " + object + " must be between " + min + " and " + max + ".");
         return false;
      }
      return true;
   }

   function checkRegex(text, regex, tips) {
      if (!(regex.test(text.val()))) {
         text.addClass("ui-state-error");
         updateTips(tips);
         return false;
      }
      return true;
   }

   $("#dialog-form").dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
         "Request Beta": function () {
            var isValid = true;
            allFields.removeClass("ui-state-error");
            isValid &= checkLength(username, "username", 3, 16);
            isValid &= checkLength(email, "email", 6.80);
            isValid &= checkRegexp(username, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter.");
            isValid &= checkRegexp(email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. username@sample.com");

            if (isValid) {

               $(this).dialog("close");
            }
         },
         Cancel: function () {
            $(this).dialog("close");

         },
         close: function () {
            allFields.val("").removeClass("ui-state-error");
         }
      }
   });

   $("#request-beta").button().click(function () {
      $("#dialog-form").dialog("open");
   });
});
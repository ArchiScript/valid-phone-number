$(document).ready(function () {
  const resultContainer = $(".result");

  $(".form").submit(function (event) {
    event.preventDefault();
    resultContainer.html("");
    resultContainer.stop(true, true).fadeIn(100);
    resultContainer.removeClass("error");
    const phoneNumber = $(".form__input").val();
    $.ajax({
      type: "POST",
      url: "validator.php",
      data: { phone: phoneNumber },
      dataType: "json",
      success: function (response) {
        let htmlContent = null;
        if (response.success == true) {
          htmlContent =
            "<ul class='result__list'>" +
            "<li>" +
            response.formatted +
            "</li>" +
            "<li>" +
            response.location +
            "</li>" +
            "<li>" +
            response.sign +
            "</li>" +
            "</ul>";
        } else {
          resultContainer.addClass("error");
          htmlContent = response.message;
          resultContainer.html(htmlContent);
          resultContainer.stop(true, true).fadeOut(3000);
        }
        if (htmlContent) {
          resultContainer.html(htmlContent);
        }
      }
    });
  });
});

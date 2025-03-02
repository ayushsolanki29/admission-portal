$(document).ready(function () {
  $(".contact-form").submit(function (e) {

    e.preventDefault();

    var form = $(this);
    var submitBtn = form.find(".message_btn");
    var formData = new FormData(this);

    // Basic Validation: Ensure required fields are filled
    var isValid = true;
    form.find("input, select, textarea").each(function () {
      var name = $(this).attr("name");
      var value = $(this).val();
    
      if (
        name &&
        value !== undefined &&
        value !== null &&
        value.trim() === "" &&
        name !== "other_topic"
      ) {

        isValid = false;
      }
    });

    if (!isValid) {
      $(".response_container").html(
        '<div class="alert alert-danger">All fields are required.</div>'
      );
      return;
    }

    $.ajax({
      type: "POST",
      url: "php/utils/contact_form.php",
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
        submitBtn.text("Sending...").prop("disabled", true);
      },
      success: function (response) {
        submitBtn.text("Send Message").prop("disabled", false);
        form[0].reset();
        $(".response_container").html(response);
      },
      error: function () {
        submitBtn.text("Send Message").prop("disabled", false);
        $(".response_container").html(
          '<div class="alert alert-danger">Something went wrong. Please try again.</div>'
        );
      },
    });
  });
});

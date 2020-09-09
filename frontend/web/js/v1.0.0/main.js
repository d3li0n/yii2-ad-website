$("#categoriesTree").select2({
  width: "style",
  theme: "classic"
});

$("#city").select2({
  width: "style",
  theme: "classic"
});

$("#currency").select2({
  width: "style",
  theme: "classic"
});

$("#price-negotiable").on("click", function() {
  if ($(this).is(":checked")) {
    $("#price-input").prop("disabled", true);
  } else {
    $("#price-input").prop("disabled", false);
  }
});

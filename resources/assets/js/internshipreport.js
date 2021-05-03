var simpleMde = null;

$(function() {
  // Edit
  $("button[name='edit']").on("click", function() {
    // Hide all edit buttons
    $("button[name='edit']").attr("hidden", true);

    // Show save and cancel buttons
    $(this)
      .parent()
      .find("button[name='cancel']")
      .removeAttr("hidden");
    $(this)
      .parent()
      .find("button[name='save']")
      .removeAttr("hidden");

    // Remove readonly attributes from the text area and the input
    $(this)
      .parents("form")
      .find("textarea")
      .removeAttr("readonly");

    $(this)
      .parents("form")
      .find("input")
      .removeAttr("readonly");

    // Get the closest textarea and make it wysiwyg editable
    setupSimpleMde(
      $(this)
        .parents("form")
        .find("textarea")
        .get(0)
    );
  });

  // Cancel edit
  $("button[name='cancel']").on("click", function() {
    // Show all edit buttons
    $("button[name='edit']").removeAttr("hidden");

    // Hide save and cancel buttons
    $(this)
      .parent()
      .find("button[name='cancel']")
      .attr("hidden", true);
    $(this)
      .parent()
      .find("button[name='save']")
      .attr("hidden", true);

    // Add readonly attributes from the text area and the input
    $(this)
      .parents("form")
      .find("textarea")
      .attr("readonly", true);

    $(this)
      .parents("form")
      .find("input")
      .attr("readonly", true);

    closeSimpleMde();
  });
  // Save
  $("button[name='save']").on("click", function() {});
});

/**
 * Wysiwyg editable
 * @param {*} element
 */
function setupSimpleMde(element) {
  simpleMde = new SimpleMDE({
    toolbar: [
      "heading",
      "heading-2",
      "heading-3",
      "|",
      "bold",
      "italic",
      "quote",
      "|",
      "unordered-list",
      "ordered-list",
      "|",
      "table",
      "link",
      "|",
      "preview",
      "side-by-side",
      "fullscreen",
    ],
    element: element,
  });
}

// Change Wysiwyg to textarea
function closeSimpleMde() {
  simpleMde.toTextArea();
  simpleMde = null;
}

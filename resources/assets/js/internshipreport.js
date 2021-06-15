var simpleMde = null;
var selectedStatus;

$(function() {
  selectedStatus = $("#status option:selected").text();

  // Edit
  $("button[name='edit']").on("click", function() {
    // Hide all edit buttons
    $("button[name='edit']").attr("hidden", true);
    // Hide all delete buttons
    $("button[name='delete']").attr("hidden", true);
    // Hide create button
    $("button[name='create']").attr("hidden", true);

    // Show save and cancel buttons
    $(this)
      .parent()
      .find("button[name='cancel']")
      .removeAttr("hidden");
    $(this)
      .parent()
      .find("button[name='save']")
      .removeAttr("hidden");

    // Show the text area and the input
    $(this)
      .parents("form")
      .find("textarea")
      .removeAttr("hidden");

    $(this)
      .parents("form")
      .find("input[type=text]")
      .removeAttr("hidden");

    // Hide the rendered input and textarea
    $(this)
      .parents("form")
      .find(".input-rendering")
      .attr("hidden", true);

    $(this)
      .parents("form")
      .find(".description-rendering")
      .attr("hidden", true);

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
    closeSimpleMde();

    // Show all edit buttons
    $("button[name='edit']").removeAttr("hidden");
    // Show all delete buttons
    $("button[name='delete']").removeAttr("hidden");
    // Hide create button
    $("button[name='create']").removeAttr("hidden", true);
    // Hide the new section
    $("#newSection").attr("hidden", true);

    // Hide save and cancel buttons
    $(this)
      .parent()
      .find("button[name='cancel']")
      .attr("hidden", true);
    $(this)
      .parent()
      .find("button[name='save']")
      .attr("hidden", true);

    $(this)
      .parents("form")
      .find("input[type=text]")
      .val(
        $(this)
          .parents("form")
          .find("input[type=text]")
          .attr("value")
      );

    // Set the textarea with its initial value
    $(this)
      .parents("form")
      .find("textarea")
      .val(
        $(this)
          .parents("form")
          .find(".raw-markdown")
          .text()
      );

    // Hide the text area and the input
    $(this)
      .parents("form")
      .find("textarea")
      .attr("hidden", true);

    $(this)
      .parents("form")
      .find("input[type=text]")
      .attr("hidden", true);

    // Show the rendered input and textarea
    $(this)
      .parents("form")
      .find(".input-rendering")
      .removeAttr("hidden");

    $(this)
      .parents("form")
      .find(".description-rendering")
      .removeAttr("hidden");
  });

  // Save
  $("section form").on("submit", function(event) {
    if (
      !$.trim(
        $(this)
          .find("input[type=text]")
          .val()
      )
    ) {
      event.preventDefault();
      alert("Le champ titre ne peut pas être vide.");
    }
  });

  // Create
  $("button[name='create']").on("click", function() {
    // Hide all edit buttons
    $("button[name='edit']").attr("hidden", true);
    // Hide create button
    $("button[name='create']").attr("hidden", true);

    $("#newSection").removeAttr("hidden");

    $("#newSection")
      .find("button[name='edit']")
      .trigger("click");
  });

  // Delete
  $("button[name='delete']").on("click", function() {
    let deleteConfirmed = confirm(
      "Etes-vous sûr de vouloir supprimer cette section?"
    );

    if (deleteConfirmed) {
      // Change laravel input to DELETE instead of PUT
      $(this)
        .parents("form")
        .find("input[name='_method']")
        .attr("value", "DELETE");

      $(this)
        .parents("form")
        .trigger("submit");
    }
  });

  // Update report status
  $("#status").on("change", function() {
    let changeConfirmed = confirm(
      "Etes-vous sûr de vouloir changer le status du rapport? Vos données non sauvegardées seront supprimées."
    );

    if (changeConfirmed) {
      $(this)
        .parent("form")
        .trigger("submit");
    }

    $(this).val(selectedStatus);
  });

  // Render the element markdown text to html
  $(".description-rendering").each(function() {
    let text = $(this).text(),
      converter = new showdown.Converter(),
      html = converter.makeHtml(text);

    $(this).html(html);
  });
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

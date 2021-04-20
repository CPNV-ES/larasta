window.addEventListener("load", () => {
  editButton = document.getElementById("edit");
  cancelButton = document.getElementById("cancel");
  saveButton = document.getElementById("save");

  editButton.addEventListener("click", () => {
    editButton.setAttribute("hidden", true);

    document.getElementsByTagName("section").forEach((section) => {
      section.querySelectorAll("input, textarea").forEach((element) => {
        element.removeAttribute("readonly");
        if (element.type == "textarea") setupSimpleMDE(element);
      });
    });

    cancelButton.removeAttribute("hidden");
    saveButton.removeAttribute("hidden");
  });

  cancelButton.addEventListener("click", () => {
    cancelButton.setAttribute("hidden", true);
    saveButton.setAttribute("hidden", true);

    document.getElementsByTagName("section").forEach((section) => {
      section.querySelectorAll("input, textarea").forEach((element) => {
        element.setAttribute("readonly", true);
      });
    });

    editButton.removeAttribute("Hidden");
  });
});

function changeButton() {}

function setupSimpleMDE(element) {
  var simplemde = new SimpleMDE({
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
  simplemde.codemirror.on("change", function() {
    description.value = simplemde.value();
  });
}
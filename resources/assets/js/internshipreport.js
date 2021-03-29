$(document).ready(() => {
  document.getElementsByName("edit").forEach((button) => {
    button.addEventListener("click", (event) => {
      event.target.setAttribute("hidden", true);
      event.target.parentElement
        .querySelectorAll("input, textarea")
        .forEach((element) => {
          element.removeAttribute("readonly");
          if (element.type == "textarea") setupSimpleMDE(element);
        });
      event.target.parentElement
        .querySelector("[name='save']")
        .removeAttribute("hidden");
    });
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

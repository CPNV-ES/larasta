$(document).ready(() => {
  document.getElementsByClassName("edit-button").forEach((button) => {
    button.addEventListener("click", (event) => {
      event.target.setAttribute("hidden", true);
      event.target.parentElement
        .querySelectorAll("input, textarea")
        .forEach((element) => element.removeAttribute("readonly"));
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
    var event = new Event("change");
    description.dispatchEvent(event);
  });
}

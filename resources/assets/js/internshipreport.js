window.addEventListener("load", () => {
  document.getElementById("edit").addEventListener("click", (event) => {
    event.target.setAttribute("hidden", true);
    document.getElementsByTagName("section").forEach((section) => {
      section.querySelectorAll("input, textarea").forEach((element) => {
        element.removeAttribute("readonly");
        if (element.type == "textarea") setupSimpleMDE(element);
      });
    });
    document.getElementById("save").removeAttribute("hidden");
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

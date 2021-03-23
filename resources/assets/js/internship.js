class InternshipUtils {
  constructor() {
    document.addEventListener("DOMContentLoaded", () => {
      this._onload();
    });
  }
  _onload() {
    this.renderMarkdown(description);
  }
  renderMarkdown(element) {
    var converter = new showdown.Converter({ tables: true });
    var text = element.innerHTML;
    var html = converter.makeHtml(text);
    element.innerHTML = html;
  }
}
var internshipUtils = new InternshipUtils();

// -----------------------Filters----------------------- //
var buttons = $("#filters").find(":checkbox");
var allButton = $("#all");
var oneButton = $("#one");

// Show buttons on page load
$(function() {
  showAllButton();
  showOneButton();
});

// Display the all button or not
function showAllButton() {
  if ($("#filters").find(":checkbox:checked").length < buttons.length)
    allButton.parent().removeAttr("hidden");
  else if ($("#filters").find(":checkbox:checked").length == buttons.length)
    allButton.parent().attr("hidden", true);
}

// Display the one button or not
function showOneButton() {
  if ($("#filters").find(":checkbox:checked").length > 1)
    oneButton.parent().removeAttr("hidden");
  else
    oneButton.parent().attr("hidden", true);
}

buttons.change(function() {
  showAllButton();
  showOneButton();

  // The last filter button will always checked
  if ($("#filters").find(":checkbox:checked").length < 1) this.checked = true;
});

allButton.change(function() {
  this.checked = false;

  // Check all buttons
  buttons.each(function() {
    this.checked = true;
  });

  showAllButton();
  showOneButton();
});

oneButton.change(function() {
  this.checked = false;

  var activeButtons = $("#filters").find(":checkbox:checked");

  // Start at 1 not to uncheck the first button
  for (var i = 1; i < activeButtons.length; i++) {
    activeButtons[i].checked = false;
  }

  showAllButton();
  showOneButton();
});

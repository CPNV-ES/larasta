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
  checkOneButton();
});

// Display the all or one button
function showAllButton() {
  if ($("#filters").find(":checkbox:checked").length < buttons.length)
    allButton.parent().removeAttr("hidden");
}

function checkOneButton() {
  if ($("#filters").find(":checkbox:checked").length > 1)
    oneButton.prop("checked", false);
}

buttons.change(function() {
  showAllButton();
  checkOneButton();

  // The last filter button will always checked
  if ($("#filters").find(":checkbox:checked").length < 1) this.checked = true;
});

allButton.change(function() {
  allButton.parent().attr("hidden", true);
  this.checked = false;

  // Check all buttons
  buttons.each(function() {
    this.checked = true;
  });

  showAllButton();
  checkOneButton();
});

oneButton.change(function() {
  var activeButtons = $("#filters").find(":checkbox:checked");

  // Start at 1 not to uncheck the first button
  for (var i = 1; i < activeButtons.length; i++) {
    activeButtons[i].checked = false;
  }

  showAllButton();
});

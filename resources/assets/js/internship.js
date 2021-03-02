class InternshipUtils {
    constructor() {
        document.addEventListener("DOMContentLoaded", ()=>{this._onload()});
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

// The last button is always checked
var buttons = $(":checkbox")

buttons.change(function () {
    if ($(":checkbox:checked").length < 1) {
        this.checked = true
    }
})
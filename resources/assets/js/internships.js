class InternshipUtils {
    constructor() {
        document.addEventListener("DOMContentLoaded", this._onload);
    }
    _onload() {
        this.renderMarkdown(description);
        this.reloadStudents();
    }
    renderMarkdown(element) {
        var converter = new showdown.Converter({ tables: true });
        var text = element.innerHTML;
        var html = converter.makeHtml(text);
        element.innerHTML = html;
    }
    reloadStudents(){
        
    }
}
var internshipUtils = new InternshipUtils();
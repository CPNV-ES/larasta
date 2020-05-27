document.addEventListener("DOMContentLoaded", function() {

    var converter = new showdown.Converter({tables: true});
    var text = description.innerHTML;
    var html = converter.makeHtml(text);
    console.log(html);
    description.innerHTML = html;
});
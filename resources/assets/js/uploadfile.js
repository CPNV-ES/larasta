var cards = document.getElementsByClassName("filecard");
[...cards].forEach(function (card) {
    var form = card.querySelector("form")
    form.addEventListener("submit", async function (event) {
        event.preventDefault();
        var url = form.dataset.action
        var formmethod = form.dataset.method
        var result = await fetch(url, {
            method: formmethod,
        })
        if(result.ok)
        {
            card.remove()
        }
    });
});


var cards = document.getElementsByClassName("filecard");
[...cards].forEach(function (card) {
    var form = card.querySelector("form")
    form.addEventListener("submit", async function (event) {
        event.preventDefault();
        var result = await fetch(form.dataset.action, {
            method: form.dataset.method,
        })
        if(result.ok)
        {
            card.remove()
        }
    });
});


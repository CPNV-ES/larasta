var cards = document.getElementsByClassName("filecard");
var token = document.querySelector('meta[name="csrf-token"]').content;
[...cards].forEach(function (card) {
    var form = card.querySelector("form")    
    form.addEventListener("submit", async function (event) {
        event.preventDefault();
        var result = await fetch(form.dataset.action, {
            method: form.dataset.method,
            headers: {
                'X-CSRF-TOKEN': token
            }
        })
        if(result.ok)
        {
            card.remove()
        }
    });
});


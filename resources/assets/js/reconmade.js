
"use strict";

document.addEventListener("DOMContentLoaded", function() {

    document.querySelectorAll('[data-internship]').forEach((elem) => {
        elem.addEventListener("click", (event) => {
            location.href = elem.dataset.internship;
        });
    });
});
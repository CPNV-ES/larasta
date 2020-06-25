document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector('.reconduction tbody tr')) {
        var listCheckboxes = document.querySelectorAll('.reconduction tbody tr input[type=checkbox]');
        var countCheckboxChecked = 0;

        check.addEventListener('click', function () {
            listCheckboxes.forEach(function (checkbox) {
                checkbox.checked = check.checked;
                countCheckboxChecked = check.checked ? listCheckboxes.length : 0
                toggleReconductButton(countCheckboxChecked);
            });
        });
        check.click();

        listCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('click', function () {
                check.checked = isCheckboxesCheked(listCheckboxes);
                checkbox.checked ? countCheckboxChecked++ : countCheckboxChecked--;
                toggleReconductButton(countCheckboxChecked);
            });
        });

        function isCheckboxesCheked(checkboxes) {
            var valid = true;
            checkboxes.forEach(function (checkbox) {
                valid &= checkbox.checked;
            });
            return valid;
        }

        function toggleReconductButton(numberCheckboxesChecked) {
            if (numberCheckboxesChecked > 0)
                reconduire.classList.remove('none');
            else
                reconduire.classList.add('none');
        }
    }
});
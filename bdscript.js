// JavaScript для фильтрации результатов таблицы поиска
document.addEventListener("DOMContentLoaded", function () {
    var searchInput = document.getElementById("qsearch");
    searchInput.addEventListener("keyup", function () {
        var searchText = searchInput.value.toLowerCase();
        var rows = document.querySelectorAll("#personal tbody tr");

        rows.forEach(function (row) {
            var nameColumn = row.querySelector("td:nth-child(2)");
            var addressColumn = row.querySelector("td:nth-child(3)");
            var phoneColumn = row.querySelector("td:nth-child(4)");
            var positionColumn = row.querySelector("td:nth-child(5)");
            var infoColumn = row.querySelector("td:nth-child(6)");

            var nameText = nameColumn.textContent.toLowerCase();
            var addressText = addressColumn.textContent.toLowerCase();
            var phoneText = phoneColumn.textContent.toLowerCase();
            var positionText = positionColumn.textContent.toLowerCase();
            var infoText = infoColumn.textContent.toLowerCase();

            if (nameText.includes(searchText) || addressText.includes(searchText) || phoneText.includes(searchText) || positionText.includes(searchText) || infoText.includes(searchText)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});




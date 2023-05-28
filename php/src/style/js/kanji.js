function showAddKanjiForm() {
    var x = $("#addKanjiForm");
    if (x.css("display") === "none") {
        x.css("display", "block");
    } else {
        x.css("display", "none");
    }
}

function updateKanjisTable() {
    $.ajax({
        url: "updateTable.php",
        method: "POST",
        data: { function_name: "getKanjis" },
        success: function (result) {
            try {
                var data = JSON.parse(result);
                var kanjiTable = $("#kanjiTable");
                kanjiTable.empty();

                for (var i = 0; i < data.length; i++) {
                    var newRow =
                        "<tr data-kanji-id='" +
                        data[i].kanji_id +
                        "'>" +
                        "<td>" +
                        data[i].kanji_character +
                        "</td>" +
                        "<td>" +
                        data[i].kanji_meaning +
                        "</td>" +
                        "<td>" +
                        data[i].kanji_kunyomi +
                        "</td>" +
                        "<td>" +
                        data[i].kanji_onyomi +
                        "</td>" +
                        "<td>" +
                        data[i].kanji_romaji_writing +
                        "</td>" +
                        "<td>" +
                        data[i].kanji_is_daily +
                        "</td>" +
                        "<td>" +
                        data[i].category_name +
                        "</td>" +
                        "<td><a href='#' class='edit-kanji'><i class='fas fa-edit'></i></a></td>" +
                        "<td><a href='#' class='delete-btn'><i class='fas fa-trash-alt'></i></a></td>" +
                        "</tr>";
                    kanjiTable.append(newRow);
                }

            } catch (e) {
                console.error("Error parsing JSON data:", e);
            }
        },
    });
}

$(document).on("click", "#kanjiTable .edit-kanji", function (e) {
    e.preventDefault();
    var row = $(this).closest("tr");
    makeRowEditable(row);
});

$(document).on("click", "#kanjiTable .delete-btn", function (e) {
    e.preventDefault();
    var row = $(this).closest("tr");
    var kanjiId = row.attr("data-kanji-id");
    var confirmDelete = confirm("Are you sure you want to delete this row?");

    if (confirmDelete) {
        deleteElement(kanjiId);
    }
});

function makeRowEditable(row) {
    var cells = row.find("td");
    var initialValue = [];

    for (var i = 0; i < cells.length - 2; i++) {
        var cell = cells.eq(i);
        initialValue.push(cell.html());

        cell.html("<input type='text' value='" + cell.html() + "'>");
    }

    var editCell = cells.eq(cells.length - 2);
    var deleteCell = cells.eq(cells.length - 1);
    editCell.hide();
    deleteCell.hide();

    var validateCell = $("<td><a href='#' class='validate-btn'><i class='fas fa-check'></i></a></td>");
    validateCell.on("click", function (e) {
        e.preventDefault();
        var newValues = [];

        for (var i = 0; i < cells.length - 2; i++) {
            var cell = cells.eq(i);
            newValues.push(cell.find("input").val());
        }

        var hasChanges = false;

        for (var i = 0; i < newValues.length; i++) {
            if (newValues[i] !== initialValue[i]) {
                hasChanges = true;
                break;
            }
        }

        if (hasChanges) {
            updateElement(row.attr("data-kanji-id"), newValues, function () {
                updateKanjisTable();
                restoreEditDeleteButtons();
            });
        } else {
            cancelCell.click();
        }
    });

    var cancelCell = $("<td><a href='#' class='cancel-btn'><i class='fas fa-times'></i></a></td>");
    cancelCell.on("click", function (e) {
        e.preventDefault();

        for (var i = 0; i < cells.length - 2; i++) {
            var cell = cells.eq(i);
            cell.html(initialValue[i]);
        }

        editCell.show();
        deleteCell.show();

        validateCell.replaceWith(editCell);
        cancelCell.replaceWith(deleteCell);
    });

    function restoreEditDeleteButtons() {
        editCell.show();
        deleteCell.show();
    }

    editCell.hide();
    deleteCell.hide();
    row.append(validateCell);
    row.append(cancelCell);
}

function updateElement(kanjiId, newValue, callback) {
    $.ajax({
        url: "updateTable.php",
        method: "POST",
        data: { function_name: "updateKanji", kanji_id: kanjiId, new_value: newValue },
        success: function (result) {
            console.log(result);
            if (callback) {
                callback();
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
        },
        complete: function () {
            updateKanjisTable();
        }
    });
}

function deleteElement(kanjiId) {
    $.ajax({
        url: "updateTable.php",
        method: "POST",
        data: { function_name: "deleteKanji", kanji_id: kanjiId },
        success: function(result) {
            console.log("Element deleted successfully");
            $('#kanjiTable').html(result); // Update the table with the updated HTML
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
}

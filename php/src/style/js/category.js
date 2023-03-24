function showAddCategoryForm() {
  var x = document.getElementById("addCategoryForm");
  console.log(x);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function updateCategoriesTable() {
  // Retrieve the updated categories data from the server using AJAX
  $.ajax({
    url: "updateTable.php",
    method: "POST",
    data: { function_name: "getCategories" },
    success: function (result) {
      try {
        console.log(result);
        var data = JSON.parse(result);
        // Clear the existing table
        $("#categoryTable").empty();
        // Loop through the returned data to create new table rows
        for (var i = 0; i < data.length; i++) {
          var newRow =
            "<tr>" +
            "<td>" +
            data[i].categories_icon +
            "</td>" +
            "<td>" +
            data[i].categories_name +
            "</td>" +
            "<td><a href='#' class='edit-category' data-category-id='" +
            data[i].categories_id +
            "'><i class='fas fa-edit'></i></a></td>" +
            "<td><a href='#' class='delete-category' data-category-id='" +
            data[i].categories_id +
            "'><i class='fas fa-trash'></i></a></td>" +
            "</tr>";
          // Append the new row to the existing table
          $("#categoryTable").append(newRow);
        }
      } catch (e) {
        console.error("Error parsing JSON data:", e);
      }
    },
  });
}

function makeRowEditable(row) {
  // Get the row's cells
  var cells = row.getElementsByTagName("td");

  // Loop through each cell and make it editable
  for (var i = 0; i < cells.length; i++) {
    var cell = cells[i];
    var text = cell.innerHTML;
    cell.innerHTML = "<input type='text' value='" + text + "'>";
  }
}

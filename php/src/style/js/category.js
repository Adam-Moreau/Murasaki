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
            "<tr data-category-id='" + data[i].id + "'>" +
            "<td>" +
            data[i].name +
            "</td>" +
            "<td><a href='#' class='edit-category'><i class='fas fa-edit'></i></a></td>" +
            "<td><a href='#' class='delete-category'><i class='fas fa-trash'></i></a></td>" +
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

  // Store the initial value of the first cell and category ID
  var initialValue = cells[0].innerHTML;
  // Loop through each cell and make it editable
  for (var i = 0; i < cells.length; i++) {
    var cell = cells[i];
    var text = cell.innerHTML;
    if (i === 0) {
      cell.innerHTML = "<input type='text' value='" + text + "'>";
    } else if (i === 1) {
      cell.innerHTML =
        "<a href='#' class='validate-btn'><i class='fas fa-check'></i></a>";
    } else if (i === 2) {
      cell.innerHTML =
        "<a href='#' class='cancel-btn'><i class='fas fa-times'></i></a>";
    }
  }

  var cancelBtn = row.querySelector(".cancel-btn");
  cancelBtn.addEventListener("click", function (e) {
    e.preventDefault();
    for (var i = 0; i < cells.length; i++) {
      var cell = cells[i];
      if (i === 0) {
        cell.innerHTML = initialValue; // Set the cell's content back to its initial value
      } else if (i === 1) {
        cell.innerHTML =
          "<a href='#' class='edit-btn'><i class='fas fa-edit'></i></a>";
      } else if (i === 2) {
        cell.innerHTML =
          "<a href='#' class='delete-btn'><i class='fas fa-trash-alt'></i></a>";
      }
    }
    var editBtn = row.querySelector(".edit-btn");
    editBtn.addEventListener("click", function (e) {
      e.preventDefault();
      makeRowEditable(row);
    });
  });

  var validateBtn = row.querySelector(".validate-btn");
  validateBtn.addEventListener("click", function (e) {
    e.preventDefault();
    var newValue = cells[0].querySelector("input").value;
    var row = validateBtn.closest("tr");
    var categoryId = row.getAttribute("data-category-id");
    if (newValue !== initialValue) {
      // Update the value in the database
      updateElement(categoryId, newValue);
      console.log(newValue);
    }
    // Restore the original row state
    cancelBtn.click();
  });


  function updateElement(categoryId, newValue, callback) {
    $.ajax({
      url: "updateTable.php",
      method: "POST",
      data: { function_name: "updateRow", category_id: categoryId, new_value: newValue },
      success: function (result) {
        console.log(result);
        if (callback) {
          callback();
        }

        updateCategoriesTable();

      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
      }
    });
  }
}



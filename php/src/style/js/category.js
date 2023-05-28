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
      console.log(result);
      try {
        var data = JSON.parse(result); // Parse the JSON data
        console.log(data);
        // Clear the existing table
        $("#categoryTable").empty();
        // Loop through the returned data to create new table rows
        for (var i = 0; i < data.length; i++) {
          var newRow =
            "<tr data-category-id='" +
            data[i].categories_id +
            "'>" +
            "<td>" +
            data[i].categories_name +
            "</td>" +
            "<td><a href='#' class='edit-category'><i class='fas fa-edit'></i></a></td>" +
            "<td><a href='#' class='delete-btn'><i class='fas fa-trash-alt'></i></a></td>" +
            "</tr>";
          // Append the new row to the existing table
          $("#categoryTable").append(newRow);
        }
        // Event delegation for "Edit" button
        $("#categoryTable").on("click", ".edit-category", function (e) {
          e.preventDefault();
          var row = $(this).closest("tr");
          console.log(row); // Debugging: Check if row is a valid element
          makeRowEditable(row);
        });

        // Remove previous event listener for delete button
        $("#categoryTable").off("click", ".delete-btn");

        // Event delegation for "Delete" button
        $("#categoryTable").on("click", ".delete-btn", function (e) {
          e.preventDefault();
          var row = $(this).closest("tr");
          var categoryId = row.attr("data-category-id");
          deleteElement(categoryId);
        });
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

  // Event delegation for "Cancel" button
  $(row).on("click", ".cancel-btn", function (e) {
    e.preventDefault();
    for (var i = 0; i < cells.length; i++) {
      var cell = cells[i];
      if (i === 0) {
        cell.innerHTML = initialValue;
      } else if (i === 1) {
        cell.innerHTML =
          "<a href='#' class='edit-category'><i class='fas fa-edit'></i></a>";
      } else if (i === 2) {
        cell.innerHTML =
          "<a href='#' class='delete-btn'><i class='fas fa-trash-alt'></i></a>";
      }
    }
  });

  // Event delegation for "Validate" button
  $(row).on("click", ".validate-btn", function (e) {
    e.preventDefault();
    var newValue = cells[0].querySelector("input").value;
    var categoryId = row.getAttribute("data-category-id");

    // Check if the new value is empty or equal to the initial value
    if (newValue === "" || newValue === initialValue) {
      // Restore the original row state
      $(row).find(".cancel-btn").click();
    } else {
      updateElement(categoryId, newValue, function () {
        updateCategoriesTable();
      });
    }
  });

}


function updateElement(categoryId, newValue, callback) {
  $.ajax({
    url: "updateTable.php",
    method: "POST",
    data: { function_name: "updateCategory", category_id: categoryId, new_value: newValue },
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

function deleteElement(categoryId) {
  var confirmDelete = confirm("Are you sure you want to delete this row?");

  if (confirmDelete) {
    $.ajax({
      url: "updateTable.php",
      method: "POST",
      data: { function_name: "deleteCategory", category_id: categoryId },
      success: function (result) {
        console.log(result);
        updateCategoriesTable();
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
      }
    });
  }
}





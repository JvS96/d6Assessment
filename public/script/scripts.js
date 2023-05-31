function displayServiceValue() {
    var selectElement = document.getElementById("invoice_data");
    var selectedValue = selectElement.value;

    // Do something with the selected value
    console.log(selectedValue); // Print the selected value to the console

    // You can also pass the selected value to another function or perform any other actions here
}
function addTableRow() {
    var table = document.getElementById("invoice_table");
    var tbody = table.getElementsByTagName("tbody")[0];

    // Create a new table row
    var newRow = document.createElement("tr");

    // Create the table cells for the new row
    var cell1 = document.createElement("td");
    var cell2 = document.createElement("td");

    // Set the cell content
    cell1.textContent = "New Data 1";
    cell2.textContent = "New Data 2";

    // Append the cells to the new row
    newRow.appendChild(cell1);
    newRow.appendChild(cell2);

    // Append the new row to the table body
    tbody.appendChild(newRow);
}

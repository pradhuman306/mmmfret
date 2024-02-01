// pdfCustomization.js
function customizePdf(doc) {
    // Calculate the number of columns
    var columnCount = doc.content[1].table.body[0].length;
    // Update the table widths for each column to be evenly distributed
    doc.content[1].table.widths = Array(columnCount).fill('*');

    doc.styles.tableHeader = {
        alignment: 'left', // Align text to left
        bold: false, // Normal font weight
        margin: [5, 8, 5, 10], // Increase the top margin to prevent overlap [left, top, right, bottom]
        fillColor: '#50C878', // Optional background color for header cells
        lineHeight: 1.00 // Line height for headers
    };

    // Set line height for table body
    doc.styles.tableBody = {
        fontSize: 10, // Set the default font size
        columnGap: 10,
        margin: [10, 10, 10, 20], // Customize margins if needed
    };

    // Footer: Add today's date and time
    var now = new Date();
    var dateTimeString = now.toLocaleString(); // Gets the date and time in local format

    doc['footer'] = (function (page, pages) {
        return {
            columns: [
                dateTimeString,
                {
                    // This is the right part (page number)
                    alignment: 'right',
                    text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }]
                }
            ],
            margin: [40, 0]
        }
    });
}

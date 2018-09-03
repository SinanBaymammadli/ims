import $ from "jquery";
import "datatables.net";
import "datatables.net-bs4";

$("#user-table-js").DataTable({
  order: [[0, "desc"]],
  pageLength: 100,
});

$("#product-table-js").DataTable({
  order: [[0, "desc"]],
  pageLength: 100,
});

$("#invoice-table-js").DataTable({
  order: [[0, "desc"]],
  pageLength: 100,
  footerCallback(row, data, start, end, display) {
    const api = this.api();
    // var data;

    // Remove the formatting to get integer data for summation
    const intVal = i => parseInt(i, 10);

    // Total over this page
    const pageTotal = api
      .column(2, { page: "current" })
      .data()
      .reduce((a, b) => intVal(a) + intVal(b), 0);

    console.log(pageTotal);

    // Update footer
    $(api.column(2).footer()).html(`TOTAL: AZN ${pageTotal / 100}`);
  },
});

$("#log-table-js").DataTable({
  order: [[0, "desc"]],
  pageLength: 100,
});

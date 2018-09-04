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
  footerCallback() {
    const api = this.api();
    // var data;

    // Remove the formatting to get integer data for summation
    const intVal = i => parseFloat(i, 10);

    // Total over all pages
    // const total = api
    //   .column(2)
    //   .data()
    //   .reduce((a, b) => intVal(a) + intVal(b), 0);

    // Total over this page
    const pageTotal = api
      .column(2, { page: "current" })
      .data()
      .reduce((a, b) => intVal(a) + intVal(b), 0);

    // Update footer
    $(api.column(2).footer()).html(`TOTAL: AZN ${pageTotal}`);
  },
});

$("#log-table-js").DataTable({
  order: [[0, "desc"]],
  pageLength: 100,
});

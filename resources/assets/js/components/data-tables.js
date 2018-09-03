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
});

$("#log-table-js").DataTable({
  order: [[0, "desc"]],
  pageLength: 100,
});

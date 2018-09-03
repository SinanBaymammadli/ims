import $ from "jquery";

function deleteResource(resourceId, form) {
  const action = form.attr("action");
  const actionArray = action.split("/");
  const currentResourceId = actionArray[actionArray.length - 1];
  const newAction = action.replace(currentResourceId, resourceId);

  form.attr("action", newAction);
}

$("#deleteUserModal").on("show.bs.modal", e => {
  const userId = $(e.relatedTarget).data("userId");
  const deleteUserForm = $("#deleteUserForm");

  deleteResource(userId, deleteUserForm);
});

$("#deleteProductModal").on("show.bs.modal", e => {
  const productId = $(e.relatedTarget).data("productId");
  const deleteProductForm = $("#deleteProductForm");

  deleteResource(productId, deleteProductForm);
});

$("#deleteInvoiceModal").on("show.bs.modal", e => {
  const invoiceId = $(e.relatedTarget).data("invoiceId");
  const deleteInvoiceForm = $("#deleteInvoiceForm");

  deleteResource(invoiceId, deleteInvoiceForm);
});

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

$("#deletePurchaseModal").on("show.bs.modal", e => {
  const purchaseId = $(e.relatedTarget).data("purchaseId");
  const deletePurchaseForm = $("#deletePurchaseForm");

  deleteResource(purchaseId, deletePurchaseForm);
});

$("#deleteOrderModal").on("show.bs.modal", e => {
  const orderId = $(e.relatedTarget).data("orderId");
  const deleteOrderForm = $("#deleteOrderForm");

  deleteResource(orderId, deleteOrderForm);
});

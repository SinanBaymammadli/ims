import React, { Component } from "react";
import PropTypes from "prop-types";

class PurchaseCreateFormRow extends Component {
  state = {};

  render() {
    const { products, deleteRow, index, isLast } = this.props;

    return (
      <tr>
        <td>
          <select className="custom-select form-control" name="product_id[]">
            {products.map(product => (
              <option key={product.id} value={product.id}>
                {product.name}
              </option>
            ))}
          </select>
        </td>
        <td>
          <input type="number" className="form-control" name="amount[]" required />
        </td>
        <td>
          <input type="number" className="form-control" name="price[]" required />
        </td>
        <td>
          {!isLast && (
            <button
              type="button"
              className="btn btn-sm btn-danger"
              onClick={() => deleteRow(index)}
            >
              <i className="far fa-trash-alt" />
              Delete
            </button>
          )}
        </td>
      </tr>
    );
  }
}

PurchaseCreateFormRow.propTypes = {
  products: PropTypes.arrayOf(PropTypes.shape({}).isRequired).isRequired,
  deleteRow: PropTypes.func.isRequired,
  index: PropTypes.string.isRequired,
  isLast: PropTypes.bool.isRequired,
};

export default PurchaseCreateFormRow;

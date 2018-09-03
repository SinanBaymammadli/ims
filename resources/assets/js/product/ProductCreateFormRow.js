import React, { Component } from "react";
import PropTypes from "prop-types";

class ProductCreateFormRow extends Component {
  state = {};

  render() {
    const { deleteRow, index, isLast } = this.props;

    return (
      <tr>
        <td>
          <input type="text" className="form-control" name="name[]" required />
        </td>
        <td>
          <input type="number" className="form-control" name="amount[]" required />
        </td>
        <td>
          <input type="number" className="form-control" name="min_required_amount[]" required />
        </td>
        <td>
          <input type="number" className="form-control" name="purchase_price[]" required />
        </td>
        <td>
          <input type="number" className="form-control" name="order_price[]" required />
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

ProductCreateFormRow.propTypes = {
  deleteRow: PropTypes.func.isRequired,
  index: PropTypes.string.isRequired,
  isLast: PropTypes.bool.isRequired,
};

export default ProductCreateFormRow;

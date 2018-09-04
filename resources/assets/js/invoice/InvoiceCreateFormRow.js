import React, { Component } from "react";
import PropTypes from "prop-types";

class InvoiceCreateFormRow extends Component {
  state = {
    amount: 0,
    price: 0,
    total: 0,
  };

  render() {
    const { products, deleteRow, index, isLast, totalChanged, position } = this.props;
    const { total } = this.state;

    return (
      <tr>
        <td>{position}</td>
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
          <input
            type="number"
            className="form-control"
            name="amount[]"
            required
            onChange={e => {
              const val = e.target.value;
              this.setState(
                prevState => ({
                  amount: val,
                  total: (prevState.price || 0) * (val || 0),
                }),
                () => {
                  totalChanged(this.state.total);
                }
              );
            }}
          />
        </td>
        <td>
          <input
            type="number"
            className="form-control"
            name="price[]"
            required
            onChange={e => {
              const val = e.target.value;
              this.setState(
                prevState => ({
                  price: val,
                  total: (prevState.amount || 0) * (val || 0),
                }),
                () => {
                  totalChanged(this.state.total);
                }
              );
            }}
          />
        </td>
        <td>{total / 100}</td>
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

InvoiceCreateFormRow.propTypes = {
  products: PropTypes.arrayOf(PropTypes.shape({}).isRequired).isRequired,
  deleteRow: PropTypes.func.isRequired,
  index: PropTypes.string.isRequired,
  isLast: PropTypes.bool.isRequired,
  totalChanged: PropTypes.func.isRequired,
};

export default InvoiceCreateFormRow;

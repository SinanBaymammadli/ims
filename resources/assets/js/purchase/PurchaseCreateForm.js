import React, { Component } from "react";
import PropTypes from "prop-types";
import ReactDOM from "react-dom";
import uuid from "uuid/v1";

import PurchaseCreateFormRow from "./PurchaseCreateFormRow";

class PurchaseCreateForm extends Component {
  state = {
    rows: [uuid()],
  };

  addRow = () => {
    this.setState(prevState => ({
      rows: [...prevState.rows, uuid()],
    }));
  };

  deleteRow = index => {
    this.setState(prevState => ({
      rows: prevState.rows.filter(row => row !== index),
    }));
  };

  render() {
    const { products } = this.props;
    const { rows } = this.state;

    return (
      <div>
        <div className="mb-3 d-flex justify-content-end">
          <button type="button" className="btn btn-sm btn-primary" onClick={this.addRow}>
            <i className="fas fa-plus" />
            Add
          </button>
        </div>

        <table className="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Amount</th>
              <th scope="col">Price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            {rows.map(row => (
              <PurchaseCreateFormRow
                key={row}
                products={products}
                deleteRow={this.deleteRow}
                index={row}
                isLast={rows.length === 1}
              />
            ))}
          </tbody>
        </table>
      </div>
    );
  }
}

PurchaseCreateForm.propTypes = {
  products: PropTypes.arrayOf(PropTypes.shape({}).isRequired).isRequired,
};

const purchaseCreateForm = document.getElementById("purchase-create-form");

if (purchaseCreateForm) {
  const { products } = purchaseCreateForm.dataset;

  ReactDOM.render(<PurchaseCreateForm products={JSON.parse(products)} />, purchaseCreateForm);
}

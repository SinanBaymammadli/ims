import React, { Component } from "react";
import ReactDOM from "react-dom";
import uuid from "uuid/v1";

import ProductCreateFormRow from "./ProductCreateFormRow";

class ProductCreateForm extends Component {
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
              <th scope="col">Min. required amount</th>
              <th scope="col">Purchase price</th>
              <th scope="col">Order price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            {rows.map(row => (
              <ProductCreateFormRow
                key={row}
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

const productCreateForm = document.getElementById("product-create-form");

if (productCreateForm) {
  ReactDOM.render(<ProductCreateForm />, productCreateForm);
}

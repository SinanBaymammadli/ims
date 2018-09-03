import React, { Component } from "react";
import PropTypes from "prop-types";
import ReactDOM from "react-dom";
import uuid from "uuid/v1";

import InvoiceCreateFormRow from "./InvoiceCreateFormRow";

class InvoiceCreateForm extends Component {
  state = {
    rows: [
      {
        price: 0,
        index: uuid(),
      },
    ],
    totalPrice: 0,
    newClient: true,
  };

  addRow = () => {
    this.setState(prevState => ({
      rows: [
        ...prevState.rows,
        {
          price: 0,
          index: uuid(),
        },
      ],
    }));
  };

  deleteRow = index => {
    this.setState(prevState => ({
      rows: prevState.rows.filter(row => row !== index),
    }));
  };

  clientChanged = e => {
    this.setState({
      newClient: e.target.value == 0,
    });
  };

  render() {
    const { products, clients } = this.props;
    const { rows, totalPrice, newClient } = this.state;

    return (
      <div>
        <div className="row">
          <div className="col">
            <div className="form-group">
              <label htmlFor="client_id">Client</label>
              <select
                className="custom-select form-control"
                name="client_id"
                onChange={this.clientChanged}
              >
                <option value="0">Add new</option>
                {clients.map(client => (
                  <option key={client.id} value={client.id}>
                    {client.name}
                  </option>
                ))}
              </select>
            </div>

            {newClient && (
              <div>
                <div className="form-group">
                  <label htmlFor="name">Client name</label>
                  <input className="form-control" type="text" name="name" id="name" />
                </div>
                <div className="form-group">
                  <label htmlFor="about">Client about</label>
                  <input className="form-control" type="text" name="about" id="about" />
                </div>
              </div>
            )}
          </div>
          <div className="col">
            <div className="row form-group">
              <div className="col">
                <label htmlFor="payment_method">Payment method</label>

                <div className="row">
                  <div className="col">
                    <div className="form-check">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="payment_method"
                        id="payment_method1"
                        value="0"
                        defaultChecked
                      />
                      <label className="form-check-label" htmlFor="payment_method1">
                        Nisye
                      </label>
                    </div>
                  </div>
                  <div className="col">
                    <div className="form-check">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="payment_method"
                        id="payment_method2"
                        value="1"
                      />
                      <label className="form-check-label" htmlFor="payment_method2">
                        Nagd
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="row form-group">
              <div className="col">
                <label htmlFor="is_sale">Invoice type</label>

                <div className="row">
                  <div className="col">
                    <div className="form-check">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="is_sale"
                        id="is_sale1"
                        value="0"
                        defaultChecked
                      />
                      <label className="form-check-label" htmlFor="is_sale1">
                        Alis
                      </label>
                    </div>
                  </div>
                  <div className="col">
                    <div className="form-check">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="is_sale"
                        id="is_sale2"
                        value="1"
                      />
                      <label className="form-check-label" htmlFor="is_sale2">
                        Satis
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

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
              <th scope="col">Total</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            {rows.map(row => (
              <InvoiceCreateFormRow
                key={row.index}
                products={products}
                deleteRow={this.deleteRow}
                index={row.index}
                isLast={rows.length === 1}
                totalChanged={total =>
                  this.setState(
                    {
                      rows: rows.map(stateRow => {
                        if (stateRow.index !== row.index) {
                          return stateRow;
                        }

                        return {
                          index: row.index,
                          price: total,
                        };
                      }),
                    },
                    () => {
                      this.setState(prevState => ({
                        totalPrice: prevState.rows.reduce(
                          (carry, stateRow) => carry + stateRow.price,
                          0
                        ),
                      }));
                    }
                  )
                }
              />
            ))}
            <tr>
              <td colSpan="5">
                Total: <input className="form-control" readOnly name="total" value={totalPrice} />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    );
  }
}

InvoiceCreateForm.propTypes = {
  products: PropTypes.arrayOf(PropTypes.shape({}).isRequired).isRequired,
};

const invoiceCreateForm = document.getElementById("invoice-create-form");

if (invoiceCreateForm) {
  const { products, clients } = invoiceCreateForm.dataset;

  ReactDOM.render(
    <InvoiceCreateForm products={JSON.parse(products)} clients={JSON.parse(clients)} />,
    invoiceCreateForm
  );
}

import React, { Component } from "react";
import ReactDOM from "react-dom";
import axios from "axios";

class Statistics extends Component {
  state = {
    data: {
      startDate: "2018-09-02",
      endDate: "2018-09-04",
    },
    total: 0,
  };

  componentDidMount = async () => {
    const { data } = this.state;
    this.getStat(data);
  };

  getStat = async data => {
    try {
      const res = await axios.post("/api/statistics", data);
      const { total } = res.data;

      this.setState({
        total,
      });
    } catch (error) {
      console.log(error);
    }
  };

  dateChanged = e => {
    const { target } = e;

    this.setState(
      prevState => ({
        data: {
          ...prevState.data,
          [target.name]: target.value,
        },
      }),
      () => {
        const { data } = this.state;
        this.getStat(data);
      }
    );
  };

  render() {
    const { total, data } = this.state;

    return (
      <div>
        <div className="row form-group">
          <div className="col-3">
            <input
              className="form-control"
              name="startDate"
              type="date"
              value={data.startDate}
              onChange={this.dateChanged}
            />
          </div>
          <div className="col-3">
            <input
              className="form-control"
              name="endDate"
              type="date"
              value={data.endDate}
              onChange={this.dateChanged}
            />
          </div>
          <div className="col-6" />
        </div>
        Satis: {total / 100} AZN
      </div>
    );
  }
}

const statistics = document.getElementById("statistics");

if (statistics) {
  ReactDOM.render(<Statistics />, statistics);
}

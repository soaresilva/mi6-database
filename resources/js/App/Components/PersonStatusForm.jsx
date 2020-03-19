import React from "react";
import PeopleList from "./PeopleList";

class PersonStatusForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            // one element for each input field on our form: it's the one that's being sent as props from the parent in PeopleList, the value that is already defined in the database. We're going to use it in the select field
            status: this.props.status
            // unless the state changes, we cannot change the value in the form, and the whole app reloads the same way as before.
        };
    }

    handleSubmit = event => {
        //prevents the submission of the form
        event.preventDefault();

        fetch("/api/person/status/change", {
            method: "POST",
            headers: {
                "Content-type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content")
            },
            body: JSON.stringify({
                person_id: this.props.id,
                status: this.state.status
            })
        });
    };

    // so we have to change state; if we didn't use an arrow function we would have to append .bind(this) when calling the function onChange (this.handleStatusChange.bind(this)). with an arrow function this happens automatically.
    handleStatusChange = event => {
        this.setState({
            status: event.target.value
        });
    };

    render() {
        return (
            <form action="" method="POST" onSubmit={this.handleSubmit}>
                <select
                    value={this.state.status}
                    onChange={this.handleStatusChange}
                >
                    {this.props.statuses.map(status => (
                        <option value={status.id} key={status.id}>
                            {status.name}
                        </option>
                    ))}
                </select>
                <input type="submit" value="Change status" />
            </form>
        );
    }
}

export default PersonStatusForm;

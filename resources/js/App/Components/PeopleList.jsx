import React from "react";

export default class PeopleList extends React.Component {
    componentDidMount() {
        fetch("/api/person")
            .then(response => response.json())
            .then(data => {
                console.log("data", data);
            });
    }

    render() {
        return <div className="loading">Loading...</div>;
    }
}

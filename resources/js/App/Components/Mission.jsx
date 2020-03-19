import React from "react";

export default class Mission extends React.Component {
    render() {
        return <li>{this.props.mission.name}</li>;
    }
}

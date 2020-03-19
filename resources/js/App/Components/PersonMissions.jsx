import React from "react";
import Mission from "./Mission";

export default class PersonMissions extends React.Component {
    constructor() {
        super();

        this.state = {
            newMission: ""
        };
    }

    handleSubmit = event => {
        //prevents the submission of the form
        event.preventDefault();

        fetch("/api/person/mission/change", {
            method: "POST",
            headers: {
                "Content-type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content")
            },
            body: JSON.stringify({
                person_id: this.props.id,
                mission: this.state.newMission
            })
        });
        console.log("this.state.newMission", this.state.newMission);
    };

    handleMissionChange = event => {
        this.setState({
            newMission: event.target.value
        });
    };

    render() {
        return (
            <ul className="missionlist">
                {this.props.missions.map((m, i) => {
                    return (
                        <Mission
                            key={i}
                            person_id={this.props.id}
                            mission={m}
                        />
                    );
                })}
                <li>
                    <form action="" method="POST" onSubmit={this.handleSubmit}>
                        <select
                            value={this.state.newMission}
                            onChange={this.handleMissionChange}
                        >
                            <option value="">Please choose</option>
                            {this.props.listOfMissions.map(mission => {
                                return (
                                    <option key={mission.id} value={mission.id}>
                                        {mission.name} ({mission.year})
                                    </option>
                                );
                            })}
                        </select>
                        <input type="submit" value="Add new mission" />
                        <input type="submit" value="Delete mission" />
                    </form>
                </li>
            </ul>
        );
    }
}

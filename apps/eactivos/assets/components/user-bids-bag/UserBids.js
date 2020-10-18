import React, {Component} from 'react';
import axios from 'axios';
import Badge from '@material-ui/core/Badge';
import Button from "@material-ui/core/Button";

class UserBids extends Component {
    constructor() {
        super();
        this.state = {userBidsCount: 0, loading: true};
    }

    componentDidMount() {
        this.getUserBids();
    }

    getUserBids() {
        axios.get(`/eactivos/public/user/ajax-bids-count`).then(data => {
            this.setState({userBidsCount: data.data, loading: false})
        })
    }

    render() {
        const loading = this.state.loading;
        return (
            <Badge badgeContent={this.state.userBidsCount} color="error">
                <Button variant="outlined">Pujas</Button>
            </Badge>
        );
    }
}

export default UserBids;


import React from 'react';

import User from "./User";

const LIMIT = 20;


class UsersList extends React.Component{
	state = {
		users: [],
        loading: false,
        pagesCount: 0,
        page: 0
    }
    
    fetchUsers = () => {
		this.setState({loading: true});
		fetch(`https://kuznia-kodu.pl/api/users?limit=20&offset=${this.state.page*LIMIT}`)
		
		.then((data) => data.json())
		
    .then((data) => {
            const users = data.results;
			const pagesCount = Math.ceil( data.count / LIMIT);
            this.setState({users: users});
            this.setState({pagesCount: pagesCount});
		})

		.finally(() =>{
			this.setState({loading: false});
		});
    }

	componentDidMount = () => {
        this.fetchUsers();
    };
    
    componentDidUpdate = (prevProps,prevState) => {
        if (prevState.page !== this.state.page) {
            this.fetchUsers();
        }
    };

	render(){
		return this.state.loading ? (
            <div>Ładuję Listę Użytkowników</div>
        ) : (
			<div>
			{
				this.state.users
				.filter((user) => {
					return user.first_name.includes(this.props.name) && user.last_name.includes(this.props.surname);
				})
				.map((user)=> {
					return <User key={user.first_name} name={user.first_name} surname={user.last_name}></User>;
				})
			}
            <br></br>
            <div>Liczba Stron {this.state.pagesCount}</div>
            <br></br>
            <div>
                Obecna Strona {this.state.page}
                <button 
                    onClick={
                        () => {
                            this.setState({page: this.state.page + 1})
                        }
                    }
                >Kolejna Strona --></button>
            </div>
			</div>
		);
	}
}

export default UsersList;
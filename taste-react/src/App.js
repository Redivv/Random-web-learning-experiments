import React from 'react';

import './App.css';

import CounterButtons from './components/CounterButtons';
import SearchBar from "./components/SearchBar";
import UsersList from "./components/UserList";



// klasa App (nazwa własna) dziedziczy od klasy Komponent, dzięki czemu mamy dostęp m.in. do funkcji render
class App extends React.Component {

	state = {
		name : '',
		surname: '',
		users: [],
		loading: false
	};

	getName = (event) => {
		this.setState({name: event.target.value});
	}

	getSurname = (event) => {
		this.setState({surname: event.target.value});
	}

	componentDidMount = () => {
		this.setState({loading: true});
		fetch('https://kuznia-kodu.pl/api/users')
		
		.then((data) => data.json())
		
    .then((data) => {
			
			this.setState({users: data.results});
		})

		.finally(() =>{
			this.setState({loading: false});
		});
	}

  render() {
    return (

		<div className="App">
			<CounterButtons></CounterButtons>
			<SearchBar name={this.state.name} getName={this.getName} surname={this.state.surname} getSurname={this.getSurname}></SearchBar>
			{/* <User name="Bynis" surname="Dynis"></User> */}
			<br/>
			<UsersList name={this.state.name} surname={this.state.surname}></UsersList>
		</div>

		);
  }
}

export default App;

import React from 'react';

class CounterButtons extends React.Component{

	state = {
		counter: 10,
	};

	incrementCounter = () => {
		this.setState({	counter: this.state.counter + 1	});
	}

	decrementCounter = () => {
		this.setState({	counter: this.state.counter - 1	});
	}

	doubleCounter = () => {
		this.setState({	counter: this.state.counter * 2	});
	}

	render(){
		return <div>

			<p>{this.state.counter}</p>

			<button onClick={this.incrementCounter}>Dodaj 1</button>
			
			<button onClick={this.decrementCounter}>Odejmij 1</button>

			<button onClick={this.doubleCounter}>Podwój</button>
		</div>
	}
}

export default CounterButtons;
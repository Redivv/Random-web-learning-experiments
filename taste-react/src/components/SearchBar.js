import React from 'react';


class SearchBar extends React.Component{

    render(){
        const {name,getName,surname,getSurname} = this.props;

        return (
        <div>
            <label>
                Imię
                <input type="text" onChange={getName} value={name}/>
            </label>
            <br/><br/>
            <label>
                Nazwisko
                <input type="text" onChange={getSurname} value={surname}/>
            </label>
        </div>
        );

    }
}

export default SearchBar;
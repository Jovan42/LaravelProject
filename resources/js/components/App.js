import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import Menu from './Menu'
import Posts from './Posts'

class App extends Component {
    render () {
        return (
            <div className="w-100 h-100 row p-0 m-0">
              <Menu />
              <Posts />
            </div>
        );
    }
}

ReactDOM.render(<App/>, document.getElementById('app'))    
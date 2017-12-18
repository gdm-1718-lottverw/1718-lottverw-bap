import React, { Component } from 'react';
import {
  Platform,
  StyleSheet,
  Text,
  View
} from 'react-native';

import store from './src/Reducers/index';
import { Provider } from 'react-redux';

import TabBarContainer from './src/Components/TabBar/index';

import Home from './src/Screens/Home';
import Calendar from './src/Screens/Calendar';
import History from './src/Screens/History';
import Profile from './src/Screens/Profile';

import PropTypes from 'prop-types';

export default class App extends Component<{}> {
  constructor(props){
    super(props);
    this.state = {
      selectedScreen: 'home',
    }
    this.screen = <Home />
    this._switchScreen = this._switchScreen.bind(this);
  }
  _switchScreen(nextScreen){
    switch(nextScreen){
      case 'home':
        this.screen = <Home />
        break;
      case 'calendar':
        this.screen = <Calendar />
        break;
      case 'user':
        this.screen = <Profile />
        break;
      case 'history':
        this.screen = <History />
        break;
      default:
        this.screen = <Home />
        break;
    }
    this.setState({selectedScreen: nextScreen});
  }
  render() {
    return (
      <Provider store={store}>
        <View style={styles.container}>
          {this.screen}
          <TabBarContainer onTabChange={this._switchScreen} />
        </View>
      </Provider>
    );
  }
}

App.propTypes = {
  selectedScreen: PropTypes.string.isRequired,
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    backgroundColor: '#FFFFFF'
  },
});
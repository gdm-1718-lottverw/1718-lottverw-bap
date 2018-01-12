import React, { Component } from 'react';
import {
  Platform,
  StyleSheet,
  Text,
  View
} from 'react-native';

import store from './src/Reducers/index';
import { Provider, connect } from 'react-redux';

import {Scene, Actions, Router} from 'react-native-router-flux';
import navigator from './src/Config/router';

import PropTypes from 'prop-types';

const ReduxRouter = connect()(Router);

export default class App extends Component<{}> {
  constructor(props){
    super(props);
  }
  onBackPress() {
    if (Actions.state.index === 0) {
      return false
    }
    Actions.pop()
    return true
  }
  render() {
    return (
      <Provider store={store}>
        <View style={styles.container}>
          <ReduxRouter  backAndroidHandler={this.onBackPress} navigator={navigator} />
        </View>
      </Provider>
    );
  }
}



const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    backgroundColor: '#FFFFFF'
  },
});
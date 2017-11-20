
import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Tabs from './src/config/router';
import { Provider } from 'react-redux';
import { createStore, applyMiddleware } from 'redux';
import AppReducers from './src/reducers/index';
import thunk from 'redux-thunk';

let store = createStore(AppReducers, applyMiddleware(thunk));
export default class App extends React.Component {
  render() {
    console.log('redux app state is:', store.getState());
    return (
      <Provider store={store}>
      <Tabs />
      </Provider>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
});




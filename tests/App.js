
import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import { Provider } from 'react-redux';
import { TabBar } from './src/components/Global/TabBar/index';
import store from './src/config/store';

function checkStoreChange(){
  store.subscribe(() => {
    console.log("Store changed. ", store.getState());
  })
}

export default class App extends React.Component {
  render() {
      checkStoreChange();
      console.log('Current State: ', store.getState());
      store.dispatch({type:'FETCH_CHILD'})
    return (
      <Provider store={store}>
        <TabBar />
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




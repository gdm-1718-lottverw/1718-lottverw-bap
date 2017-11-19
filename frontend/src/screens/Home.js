import NowReducers from '../reducers/index';
import React, { Component } from 'react';
import { StyleSheet, View, Text, ToolbarAndroid } from 'react-native';
import TopBar from '../component/bar';
import Colors from '../config/theme';
import List from './List';
import { Provider } from 'react-redux';
import { createStore } from 'redux';

let store = createStore(NowReducers);
class Home extends React.Component{    
    componentDidMount(){
        setInterval(() => {
            this._fetchServiceStatus(),
            console.log('Pulling in the data from external API')
        }, 5000);
    }
    _fetchServiceStatus(){
        var headers = { 'Content-Type': 'application/json' }
        fetch('http://127.0.0.1:8000/api/child/1', {headers: headers})
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const newState = this.state.services.map(s => (
                    Object.assign(s, {
                        name: data[s.key].name
                    })
                ))
            })
            .catch(function(error) {
                console.log('There has been a problem with your fetch operation: ' + error.message);
                throw error;
            });
    }
  render(){
     // console.log('Resux/app state is: ', store.getState())
      return (
        <Provider store={store}>
            <View style={styles.box}>
                <TopBar title={'HOME'}/>
            </View>
        </Provider>
      )
  }
}

const styles = StyleSheet.create({
    box: {
        flex: 1,
    },
});
    
export default Home;
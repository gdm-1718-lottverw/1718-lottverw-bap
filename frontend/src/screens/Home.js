import React, { Component } from 'react';
import { StyleSheet, View, Text, ToolbarAndroid, ScrollView } from 'react-native';
import TopBar from '../components/TopBar/index';
import Colors from '../config/theme';

class Home extends React.Component{    
  render(){
    function getMoviesFromApiAsync() {
        return fetch('https://facebook.github.io/react-native/movies.json')
          .then((response) => response.json())
          .then((responseJson) => {
            return responseJson.movies;
          })
          .catch((error) => {
            console.error(error);
          });
      }
      return (
            <View style={styles.box}>
                <TopBar title={'HOME'}/>
                <ScrollView>
            
                </ScrollView>
            </View>
      )
  }
}

const styles = StyleSheet.create({
    box: {
        flex: 1,
    },
});
    
export default Home;
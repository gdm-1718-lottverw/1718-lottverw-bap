import React, { Component } from 'react';
import { StyleSheet, View, Text, ToolbarAndroid } from 'react-native';
import TopBar from '../component/bar';
import Colors from '../config/theme';
class Home extends React.Component{    
  render(){
      return (
            <View style={styles.box}>
                <TopBar title={'HOME'}/>
                <View></View>
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
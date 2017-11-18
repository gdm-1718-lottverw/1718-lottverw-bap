import React, { Component } from 'react';
import { StyleSheet, View } from 'react-native';
import TopBar from '../component/bar';
class Home extends React.Component{    
  render(){
      return (
            <View style={styles.box}>
                <TopBar title={'HOME'}/>
            </View>
      )
  }
}

const styles = StyleSheet.create({
    box: {
        flex: 1,
        flexDirection: 'column',
        justifyContent: 'center',
        alignItems: 'center',
    }
});
    
export default Home;
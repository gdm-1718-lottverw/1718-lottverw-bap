import React, { Component } from 'react';
import { StyleSheet, View, Text, ToolbarAndroid, ScrollView } from 'react-native';
import Colors from '../config/theme';
import { connect } from 'react-redux';
import { fetchChild } from '../actions/childActions';
import TopBar from '../components/Global/TopBar/index';
@connect((store) => {
    return {
        child: store.child.child, 
        fetched: store.child.fetched
    }
})
class Home extends React.Component{    
    componentWillMount(){
      this.props.dispatch(fetchChild()); 
    }
  render(){
      console.log(this.props.child);
      return (
            <View style={styles.box}>
                <TopBar title={'HOME'}/>
                <ScrollView>
                    <Text>{this.props.child != undefined ? this.props.child.name : 'No child'}</Text>
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
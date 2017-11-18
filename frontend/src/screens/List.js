import React, { Component } from 'react';
import { StyleSheet, Text, View } from 'react-native';
import TopBar from '../component/bar';
class List extends React.Component{
    render(){
        return (
            <View style={styles.box}>
            <TopBar title={'LIST'}/>
        </View>
        );
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
export default List;
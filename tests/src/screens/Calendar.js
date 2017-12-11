import React, { Component } from 'react';
import { StyleSheet, Text, View } from 'react-native';
import TopBar from '../components/Global/TopBar/index';

class Calendar extends React.Component{
    render(){
        return (
            <View style={styles.box}>
                <TopBar title={'CALENDAR'}/>
            </View>
        );
    }
}
  
const styles = StyleSheet.create({
    box: {
        flex: 1,
    }
});
export default Calendar;
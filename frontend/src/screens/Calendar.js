import React, { Component } from 'react';
import { StyleSheet, Text, View } from 'react-native';
import TopBar from '../Components/TopBar/index';
import CalendarSevice from '../Actions/Calendar/CalendarActions';

class CalendarScreen extends React.Component{
    constructor(props) {
        super(props);
        this.state = {}
    }    
    render(){
        return (
            <View style={styles.box}>
                <TopBar title={'CALENDAR'}/>
                <CalendarSevice />
            </View>
        );
        
    }


}
const styles = StyleSheet.create({
    box: {
        flex: 1,
    }
});
export default CalendarScreen;
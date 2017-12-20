import React, { Component } from 'react';
import { StyleSheet, Text, View } from 'react-native';
import TopBar from '../Components/TopBar/index';
import { Calendar, CalendarList, Agenda, LocaleConfig} from 'react-native-calendars';
class CalendarScreen extends React.Component{
    constructor(props) {
        super(props);
        this.state = {
          items: {}
        };
    }    
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
    },
    calendar: {
        marginTop: 90
    }
});
export default CalendarScreen;
import React, { Component } from 'react';
import { StyleSheet, Text, View } from 'react-native';
import TopBar from '../Components/TopBar/index';
import HistorySevice from '../Actions/History/HistoryActions';
class History extends React.Component{
    render(){
        return (
            <View style={styles.box}>
                <TopBar title={'HISTORY'}/>
                <HistorySevice />
            </View>
        );
    }
}
  
const styles = StyleSheet.create({
    box: {
        flex: 1,
    }
});
export default History;
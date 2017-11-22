import React, { Component } from 'react';
import { StyleSheet, Text, View, ScrollView, TextInput, Platform, TouchableOpacity } from 'react-native';
import KeyboardSpacer from 'react-native-keyboard-spacer';
import TopBar from '../components/TopBar/index';

// Make shure the keyboard will not mess with the view.
const spacer = Platform.OS == 'ios' ? <KeyboardSpacer/> : null;

class Profile extends React.Component {
    render() {
        return (
            <View style={styles.box}>
                <TopBar title={'PROFILE'}/>
                <ScrollView>

                </ScrollView>
                {spacer}
            </View>
        )
    };
}

const styles = StyleSheet.create({
    box: {
        flex: 1,
    }, 
    button: {
        padding: 3,  
        width: 70, 
        backgroundColor: '#fefefe'
    },
    input: {
        borderBottomWidth: 3,
        borderBottomColor: 'red'
    }
});
export default Profile;
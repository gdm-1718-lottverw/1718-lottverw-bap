import React, { Component } from 'react';
import { StyleSheet, Text, View, ScrollView, TextInput, Platform, TouchableOpacity } from 'react-native';
import TopBar from '../Components/TopBar/index';
import ProfileSevice from '../Actions/Profile/ProfileActions';

class Profile extends React.Component {
    render() {
        return (
            <View style={styles.box}>
                <TopBar title={'PROFILE'} icon={'power-off'} pop={false}/>
                <ProfileSevice />
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
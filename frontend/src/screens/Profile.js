import React from 'react';
import { StyleSheet, Text, View, TextInput, TouchableOpacity } from 'react-native';
import TopBar from '../components/TopBar/index';
import PropTypes from 'prop-types';
const Profile = (props) => {
    return (
        <View style={styles.box}>
        <TopBar title={'PROFILE'}/>
        <View>
            <Text>Name: </Text>
            <TextInput style={styles.input} value={props.name} onChangeText={props.onNameUpdate}/>
            <TouchableOpacity style={styles.button} ><Text>Submit</Text></TouchableOpacity>
        </View>
    </View>
    )
};

Profile.propTypes = {
    name: PropTypes.string,
    onNameUpdate: PropTypes.func.isRequired
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
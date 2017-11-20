import React, {Component } from 'react';
import { StyleSheet, Text, View, ScrollView, TextInput, Platform, TouchableOpacity } from 'react-native';
import TopBar from '../components/TopBar/index';
import PropTypes from 'prop-types';
import KeyboardSpacer from 'react-native-keyboard-spacer';

// Make shure the keyboard will not mess with the view.
const spacer = Platform.OS == 'ios' ? <KeyboardSpacer/> : null;
let apiPollIntervalId;
var child = {};
class Profile extends React.Component {
    constructor(props){
        super(props);
        this._fetchResponses = this._fetchResponses.bind(this);
    }

    componentDidMount(){
        apiPollIntervalId = setInterval(this._fetchResponses, 5000)
    }

    componentWillUnMount(){
        clearInterval(apiPollIntervalId);
    }
    _fetchResponses(){
        fetch('http://192.168.1.155:8000/api/child/1')
            .then(response => response.json())
            .then(data => {
                if(data && data.child){
                    this.props.onReceivedChild(data);
                }
            })
            .catch(error => {
                console.log(error.message);
            })
    }
    render() {
        return (
            <View style={styles.box}>
                <TopBar title={'PROFILE'}/>
                <ScrollView>
                    <Text> {child.name} </Text>
                    <Text>Name: {child.name} </Text>
                    <TextInput style={styles.input} value={this.props.name} onChangeText={this.props.onNameUpdate}/>
                    <TouchableOpacity style={styles.button} ><Text>Submit</Text></TouchableOpacity>
                </ScrollView>
                {spacer}
            </View>
        )
    };
}
Profile.propTypes = {
    name: PropTypes.string,
    child: PropTypes.object,
    onNameUpdate: PropTypes.func.isRequired,
    onReceivedChild: PropTypes.func.isRequired,
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
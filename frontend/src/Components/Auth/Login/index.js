import React, { Component } from 'react';
import { StyleSheet, Text, View, ListView, ActivityIndicator, TextInput, TouchableOpacity } from 'react-native';
import { connect }from 'react-redux';
import { Actions } from 'react-native-router-flux';
import Icon  from 'react-native-vector-icons/FontAwesome';
import store from '../../../Reducers/index';
class LoginService extends Component {
  constructor(props) {
    super(props);
    this.state = {
      username: '',
      password: '',
    }
    error = "";
  }
  componentDidMount() {
    console.log("ON MOUNT SHOW DEM PROPS", this.props);
  }   
  componentWillReceiveProps(nextProps) {
    console.log('NEXT PROPS: ', nextProps);  
    this.error = nextProps.error
  }
  
      render() {
        return (
          <View  style={styles.container}>
          <Text>{this.error}</Text>
            <Text>username</Text>
            <TextInput
                style={{height: 40, borderColor: 'gray', borderWidth: 1}}
                onChangeText={(username) => {this.setState({username})}}
                value={this.state.username}
            />
            <Text>password</Text>
            <TextInput
                style={{height: 40, borderColor: 'gray', borderWidth: 1}}
                onChangeText={(password) => this.setState({password})}
                value={this.state.password}
            />
            <TouchableOpacity
                onPress={() => {
                  console.log('STATE: ', JSON.stringify(this.state));
                  this.props.login(JSON.stringify(this.state)); 
                }}>
                <Text>Log in</Text>
            </TouchableOpacity>
          </View>
        );
      }
}


export default connect()(LoginService);
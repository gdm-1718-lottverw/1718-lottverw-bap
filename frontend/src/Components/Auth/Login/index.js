import React, { Component } from 'react';
import { StyleSheet, Text, View, ListView, ActivityIndicator, TextInput, TouchableOpacity } from 'react-native';
import { connect }from 'react-redux';
import { Actions } from 'react-native-router-flux';
import Icon  from 'react-native-vector-icons/FontAwesome';
import store from '../../../Reducers/index';
import styles from './styles';

class LoginService extends Component {
  constructor(props) {
    super(props);
    this.state = {
      username: '',
      password: '',
    }
    error = "";
  }
  componentDidMount() {}   
  componentWillReceiveProps(nextProps) {
    if(nextProps.error == true){
      this.error = nextProps.error
    } 
  }
  
      render() {
        return (
          <View  style={styles.container}>
          <Text>{this.error}</Text>
            <Text style={styles.label}>username</Text>
            <TextInput
                style={styles.textInput}
                onChangeText={(username) => {this.setState({username})}}
                value={this.state.username}/>

            <Text style={styles.label}>password</Text>
            <TextInput
                style={styles.textInput}
                onChangeText={(password) => this.setState({password})}
                value={this.state.password}/>
            
            <TouchableOpacity
                style={styles.btn}
                onPress={() => {
                  this.props.login(JSON.stringify(this.state)); 
                }}>
                <Text style={styles.btnText}>Log in</Text>
            </TouchableOpacity>
          </View>
        );
      }
}


export default connect()(LoginService);
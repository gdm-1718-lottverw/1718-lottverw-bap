import React, { Component } from 'react';
import { StyleSheet, View, Text, ScrollView, TextInput, TouchableOpacity } from 'react-native';
import { connect } from 'react-redux';
import Colors from '../Config/theme';
import LoginService from '../Actions/Login/AuthAction';
class Login extends React.Component{  
    constructor(props){
        super(props);
    }

render(){  
      return (
        <View style={styles.box}>
            <LoginService />
        </View>
      )

  }
}
const styles = StyleSheet.create({
    box: {
        flex: 1,
    },
});
    
export default Login;

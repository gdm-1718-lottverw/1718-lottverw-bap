import React, { Component } from 'react';
import { StyleSheet, View, Image } from 'react-native';
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
            <Image style={styles.logo} source={require('../Assets/logo.png')} />
            <LoginService />
        </View>
      )

  }
}
const styles = StyleSheet.create({
    box: {
        flex: 1,
        padding: 30,
        alignItems: 'center'
    },
    logo: {
      marginBottom: 15
    }
});
    
export default Login;

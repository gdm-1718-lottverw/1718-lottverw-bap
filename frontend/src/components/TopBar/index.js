import React, { Component } from 'react';
import { Text, View, TouchableOpacity } from 'react-native';
import styles from './styles';
import  Icon  from 'react-native-vector-icons/FontAwesome';
import { Actions } from 'react-native-router-flux';

export default class TopBar extends React.Component {        
  render(){
      const title = this.props.title;
      console.log(this.state)
      return (
        <View  style={styles.container}>
            <Text style={styles.text}> {title} </Text>
            <TouchableOpacity  onPress={() => { Actions.login() }}>
            	<Icon style={styles.icon} name={'power-off'} size={20}/>
            </TouchableOpacity>
        </View>
    );
  }
}

    
import React, { Component } from 'react';
import { Text, View } from 'react-native';
import styles from './styles';
import  Icon  from 'react-native-vector-icons/FontAwesome';
export default class TopBar extends React.Component {        
  render(){
      const title = this.props.title;
      return (
        <View  style={styles.container}>
            <Text style={styles.text}> {title} </Text>
            <Icon style={styles.icon} name={'power-off'} size={20}/>
        </View>
    );
  }
}

    
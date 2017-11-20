import React, { Component } from 'react';
import { Text, View } from 'react-native';
import styles from './styles';
export default class TopBar extends React.Component {        
  render(){
      const title = this.props.title;
      return (
        <View  style={styles.container}>
            <Text style={styles.element}> {title} </Text>
        </View>
    );
  }
}

    
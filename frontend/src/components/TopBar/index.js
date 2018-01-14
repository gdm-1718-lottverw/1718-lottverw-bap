import React, { Component } from 'react';
import { Text, View, TouchableOpacity } from 'react-native';
import styles from './styles';
import  Icon  from 'react-native-vector-icons/FontAwesome';
import { Actions } from 'react-native-router-flux';
import GenerateLoading from '../Loading/index'; 

export default class TopBar extends React.Component {        
  render(){
      const title = this.props.title;
      const icon = this.props.icon; 
      const pop = this.props.pop;
      var loading = false;
      return (
        <View style={styles.container}>
          <Text style={styles.text}> {title} </Text>
          <TouchableOpacity  onPress={() => {pop == false? Actions.login(): Actions.pop(); this.loading = true}}>
            <Icon style={styles.icon} name={icon} size={20}/>
          </TouchableOpacity>
        </View>
    );
  }
}

    
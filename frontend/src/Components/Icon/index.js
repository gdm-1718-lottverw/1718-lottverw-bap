import React, {Component} from 'react';
import {
  Text, View
} from 'react-native';

import Icon from 'react-native-vector-icons/FontAwesome';
import Colors from '../../Config/theme';


const GenerateIcon = (props) => {
  return (
      <Icon style={styles.icon} name={props.name} size={props.size}/>
  );
}


export default GenerateIcon;
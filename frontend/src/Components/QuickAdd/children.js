import React, { Component } from 'react';
import { View, Text, TouchableOpacity } from 'react-native';
import { Actions } from 'react-native-router-flux';
import PropTypes from 'prop-types';
import styles from './styles';

class ChildrenService extends React.Component{  
    constructor(props){
    super(props);

  }

  render() {
    console.log( this.props.children);
    return (
      <View style={{ flex: 1, backgroundColor: 'red' }}>
        {
         this.props.children.map((child, index) => {
           return <Text key={index}>{child.name}</Text>
         })
        }
      </View>
    );
  }
}

ChildrenService.propTypes = {
  children: PropTypes.array
}

    
export default ChildrenService;


import React, { Component } from 'react';
import { StyleSheet, Text, View, Dimensions} from 'react-native';

export default class TopBar extends React.Component {        
  render(){
      const title = this.props.title;
      return (
            <Text style={styles.element}>{title}</Text>
        );
  }
}

var width = Dimensions.get('window').width;
const styles = StyleSheet.create({
    element: {
        width: width,
        position: 'absolute',
        top: 0,
        color: '#FFFFFF',
        paddingTop: 2,
        marginTop: 30,
        fontSize: 18,
        fontWeight: '900',
        textAlign: 'center',
        backgroundColor: 'black',
        height: 30,
        alignSelf: 'stretch',
    },
});
    
import React, { Component } from 'react';
import { StyleSheet, Text, View, Dimensions} from 'react-native';
import Colors from '../config/theme';
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

var width = Dimensions.get('window').width;

const styles = StyleSheet.create({
    container: {
        alignSelf: "stretch",
        justifyContent: 'flex-start',
        flex: 1,
        maxHeight: 70,
        backgroundColor: Colors.black,
    },
    element: {
        backgroundColor: Colors.darkBlue,
        top: 23,
        textAlign: 'center',
        height: 47,
        padding: 13,
        color: Colors.white,
        fontWeight: '700',
        fontFamily: "Roboto"
    },
});
    
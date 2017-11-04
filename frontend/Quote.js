import React, { Component } from 'React';
import { View, Text, StyleSheet } from 'react-native';

export default class Quote extends Component {
    render(){
        return (
            <View>
            <Text>{this.props.quoteText}</Text>
            <Text>{this.props.quoteSource}</Text>
            </View>
        );
    }
}
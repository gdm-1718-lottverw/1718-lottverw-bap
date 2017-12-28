import React, { Component } from 'react';
import { View, Text, ScrollView, TouchableOpacity, TextInput, Picker, Button } from 'react-native';
import { Actions } from 'react-native-router-flux';
import PropTypes from 'prop-types';
import styles from './styles';
import ChildrenService from './children';

class QuickAddService extends React.Component{  
  constructor(props){
    super(props);
    console.log('QAS', this.props);
    this.state = {
      type: '',
      parent_notes: '',
      date: this.props.date,
      children: []
    }
  }

  componentDidMount() {
    this.props.fetchChildren(this.props.token, this.props.id);
  }   

  componentWillReceiveProps(nextProps) {
   if (nextProps.data.length > 0 && nextProps.error == undefined) {
      this.state.children = nextProps.data;
    } 
  }

  render(){  
    return (
      <View>
        <View><Button onPress={() =>{Actions.pop()}} title='Back'/></View>
        <View style={styles.container}>
          <Text style={styles.label}>Kies een datum</Text>
          <Text>{this.props.date}</Text>
          <Text style={styles.label}>Dag type</Text>
          <Picker
            selectedValue={this.state.type}
            onValueChange={(value, index) => this.setState({type: value})}>
            <Picker.Item label="Voormiddag" value="morning" />
            <Picker.Item label="Namiddag" value="afternoon" />
            <Picker.Item label="Volledige dag" value="full day" />
          </Picker>
          <Text style={styles.label}>Kind(eren)</Text>
            {this.state.children !== undefined && this.state.children.length > 0? <ChildrenService style={styles.picker} children={this.state.children}/> : console.log(this.state.children)}
            <Text style={styles.label}>Opmerkingen</Text>
            <TextInput
              style={styles.textInput}
              onChangeText={(parent_notes) => {this.setState({parent_notes})}}
              value={this.state.parent_notes}/>
            <Text style={styles.label}>Mag zelfstandig naar huis</Text>
          </View>
          <View>
            <TouchableOpacity style={styles.btn}>
              <Text style={styles.btnText}>BEWAREN</Text>
            </TouchableOpacity>
          </View>
        </View>
      );

  }
}

QuickAddService.propTypes = {
  date: PropTypes.string,
}

    
export default QuickAddService;


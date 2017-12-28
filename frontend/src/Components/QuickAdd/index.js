import React, { Component } from 'react';
import { View, Text, ScrollView, TouchableOpacity, TextInput, Picker, Button } from 'react-native';
import { Actions } from 'react-native-router-flux';
import PropTypes from 'prop-types';
import styles from './styles';
import ChildrenService from './children';

class QuickAddService extends React.Component{  
  constructor(props){
    super(props);
    this.state = {
      type: '',
      go_home_alone: false,
      parent_notes: '',
      date: this.props.date,
      children: [],
      child_id: []
    }
  }

  componentDidMount() {
    this.props.fetchChildren(this.props.token, this.props.id);
  }   

  componentWillReceiveProps(nextProps) {
          console.log('NEXT PROPS', nextProps.data);

   if (nextProps.data.length > 0 && nextProps.error == undefined) {
      console.log('NEXT PROPS', nextProps.data);
      this.state.children = nextProps.data;
    } 
  }
  addChild = (id) => {
    console.log('ADD CHILD', id);
    this.state.child_id.push(id);
  }

  renderChild = (children) => {
    console.log('IN RENDER CHILD', children);
    return children.map((child, i) => {
      return (<TouchableOpacity key={i} onPress={() => {this.addChild(child.id)}}>
                <Text>{ child.name}</Text>
              </TouchableOpacity>);
    })
  }
  
renderCheckbox = () => {
    const options = [{key: 'ja', value: true},{key: 'neen', value: false}];
    console.log(options);
    return  options.map((option, i) => {
      return (<TouchableOpacity 
                key={i} 
                onPress={() => {
                  this.setState({go_home_alone: option.value})
                }}>
                <Text>{option.key}</Text>
              </TouchableOpacity>);
    })
  }
  submit = () => {
    let data = {
      child_id: this.state.child_id,
      date: this.state.date,
      parent_notes: this.state.parent_notes,
      type: this.state.type, 
      go_home_alone: this.state.go_home_alone
    }
    this.props.submitNewAttendance(this.props.token, this.props.id, JSON.stringify(data));
  }

  render(){  
    return (
      <View>
        <View><Button onPress={() =>{Actions.pop()}} title='Back'/></View>
        <View style={styles.container}>
          <Text style={styles.label}>{'Datum'.toUpperCase()}</Text>
          <Text>{this.props.date}</Text>
          <Text style={styles.label}>{'Dag type'.toUpperCase()}</Text>
          <Picker
            selectedValue={this.state.type}
            onValueChange={(value, index) => {this.setState({type: value})}}>
            <Picker.Item label="Kies een item" />
            <Picker.Item label="Voormiddag" value="morning" />
            <Picker.Item label="Namiddag" value="evening" />
            <Picker.Item label="Volledige dag" value="full day" />
          </Picker>
          <Text style={styles.label}>{'Kind(eren)'.toUpperCase()}</Text>
          {this.state.children !== undefined && this.state.children.length > 0 ? this.renderChild(this.state.children) : console.log('UNDEFINED CHILDREN', this.state.children)}

            <Text style={styles.label}>{'Opmerkingen'.toUpperCase()}</Text>
            <TextInput
              style={styles.textInput}
              onChangeText={(parent_notes) => {this.setState({parent_notes})}}
              value={this.state.parent_notes}/>
            <Text style={styles.label}>Mag zelfstandig naar huis</Text>
             {this.renderCheckbox()}
          </View>
          <View>
            <TouchableOpacity style={styles.btn} onPress={() => {this.submit()}}>
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


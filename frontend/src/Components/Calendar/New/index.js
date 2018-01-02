import React, { Component } from 'react';
import { View, Text, ScrollView, TouchableOpacity, TextInput, Picker, Button } from 'react-native';
import { Actions } from 'react-native-router-flux';
import PropTypes from 'prop-types';
import styles from './styles';
import Icon from 'react-native-vector-icons/FontAwesome';

class NewCalendarService extends React.Component{  
  constructor(props){
    super(props);
    this.state = {
      type: '',
      go_home_alone: false,
      parent_notes: '',
      date: this.props.date,
      children: [],
      child_id: [],
      
      check_child_id: '',
      check_type: '',
      check_go_home_alone: false,
      check_child_id: '',

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

  addChild = (id) => {
    this.state.child_id.push(id);
  }

  setCheck = (item, patcho) => {
       var a = {backgroundColor: '#000000', height: 10, width:10, borderRadius: 7,  marginTop: 5, marginRight: 5};
       var b = {backgroundColor: '#FFFFFF', borderColor: '#000', borderWidth: 1, height: 10, width:10, borderRadius: 7, marginTop: 5, marginRight: 5};
       switch('check_'+patcho){
        case item.name: 
          return a;
          break;
        default: 
          return b;
          break;
       }
  }

  generateIcon = (name, size) => (
      <Icon style={styles.icon} name={name} size={size}/>
  );

  renderChecklist = (obj, patch) => {             
    return obj.map((item, i) => {
      if(this.state[patch] == item.id){
        this.state['check_'+patch] = item.name;
      }
      return (
        <TouchableOpacity style={styles.check} key={i} onPress={() => {this.setState({[patch]: item.id}); this.setState({['check_'+patch]: item.name})}}>
         <View style={this.setCheck(item, this.state[patch])}></View>
         <Text style={styles.checkText}>{item.name}</Text>
        </TouchableOpacity>)
      })
  }

    renderChildren = (obj, patch) => {             
    return obj.map((item, i) => {
      if(this.state[patch] == item.id){
        this.state['check_'+patch] = item.name;
      }
      return (
        <TouchableOpacity style={styles.check} key={i} onPress={() => {this.state.child_id.push(item.id)}}>
         <View style={this.setCheck(item, this.state[patch])}></View>
         <Text style={styles.checkText}>{item.name}</Text>
        </TouchableOpacity>)
      })
  }


  submit = () => {
    let data = {
      child_id: this.state.child_id,
      date: this.state.date,
      parent_notes: this.state.parent_notes,
      type: this.state.type, 
      go_home_alone: this.state.go_home_alone
    };
    console.log(data);
    this.props.submitNewAttendance(this.props.token, this.props.id, JSON.stringify(data));
  }

  render(){  
    const types = [{name: 'voormiddag', id: 'voormiddag'}, {name: 'namiddag', id: 'namiddag'}, {name: 'hele dag', id: 'hele dag'}];
    const bool = [{name: 'Mag alleen naar huis', id: true}, {name: 'Wordt opgehaald', id: false}];

    return (
      <ScrollView style={styles.container}>
        <View style={styles.item}>
          {this.generateIcon('calendar', 15)}
          <Text style={[styles.label, styles.single ]}>Ingeschreven voor: {this.props.date}</Text>            
        </View>
        <View>
        <View style={styles.item}>
          {this.generateIcon('user-circle-o', 15)}
          <Text style={styles.label}>Kind(eren)</Text>
          <View style={styles.description}>
           {this.state.children !== undefined && this.state.children.length > 0 ? this.renderChildren(this.state.children, 'child_id') : null}
          </View>              
        </View>
        <View style={styles.item}>
          {this.generateIcon('sun-o', 15)}
          <Text style={styles.label}>Dag type</Text>
          <View style={styles.description}>
            {this.renderChecklist(types, 'type')}
          </View>              
        </View> 
        <View style={styles.item}>
          {this.generateIcon('sun-o', 15)}
          <Text style={styles.label}>Mag alleen naar huis.</Text>
          <View style={styles.description}>
            {this.renderChecklist(bool, 'go_home_alone')}
          </View>              
        </View>      
        <View style={styles.item}>
          {this.generateIcon('comment-o', 15)}
          <Text style={styles.label}>Opmerkingen</Text>
          <View style={styles.description}>
            <TextInput
            style={styles.textInput}
            onChangeText={(parent_notes) => {this.setState({parent_notes})}}
            value={this.state.parent_notes}/>
          </View>              
        </View>            
         
        </View>
        <View>
          <TouchableOpacity style={styles.btn} onPress={() => {this.submit()}}>
            <Text style={styles.btnText}>BEWAREN</Text>
          </TouchableOpacity>
        </View>
      </ScrollView>
      );

  }
}

NewCalendarService.propTypes = {
  date: PropTypes.string,
}

    
export default NewCalendarService;


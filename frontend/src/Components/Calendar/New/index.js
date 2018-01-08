import React, { Component } from 'react';
import { View, Text, ScrollView, TouchableOpacity, TextInput, Picker, Button } from 'react-native';
import { Actions } from 'react-native-router-flux';
import PropTypes from 'prop-types';
import styles from './styles';
import GenerateIcon from '../../Icon/index';

class NewCalendarService extends React.Component{  
  constructor(props){
    super(props);
    this.state = {
      type: '',
      go_home_alone: false,
      parent_notes: '',
      date: this.props.date,
      // All parent childen.
      children: [],
      // For adding to db.
      child_id: [],
      // Just for radiubutton 
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

  setCheck = (item, patcho) => {
       var a = {backgroundColor: '#000000', height: 10, width:10, borderRadius: 7,  marginTop: 5, marginRight: 5};
       var b = {backgroundColor: '#FFFFFF', borderColor: '#000', borderWidth: 1, height: 10, width:10, borderRadius: 7, marginTop: 5, marginRight: 5};
       
       if(Array.isArray(patcho)){
          for(var i = 0; i < patcho.length; i++){
           if(patcho[i] == item.id){
             console.log('.SAME.', patcho[i], item.id)
             return a;
           }
         }
         return b;
       } else {
        switch(patcho){
          case item.name: 
            return a;
            break;
          default: 
            return b;
            break;
        }
    }
  }

  renderChecklist = (obj, patch) => {      
    const state_item = 'check_' + patch;      
    return obj.map((item, i) => {
      return (
        <TouchableOpacity style={styles.check} key={i} onPress={() => {this.setState({[patch]: item.id}); this.setState({[state_item]: item.name})}}>
         <View style={this.setCheck(item, this.state[state_item])}></View>
         <Text style={styles.checkText}>{item.name}</Text>
        </TouchableOpacity>)
      })
  }

  renderChildren = (obj, patch) => {   
    spliceState =(index) => {
      let a = this.state.child_id.splice(index, 1);
      this.setState([patch]: a);
    }          
    return obj.map((item, i) => {
      i*3;
      var index; var active = false;
     for(var o=0; o<this.state[patch].length; o++){
        if(this.state[patch][o] == item.id){
         var active = true;
         var index = this.state[patch].indexOf(item.id);
        }
     }
      return (
        <TouchableOpacity style={styles.check} key={i} onPress={() => {!active? this.setState({[patch]: [...this.state[patch], item.id]}): spliceState(index)}}>
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
          <GenerateIcon name={'calendar'} size={15} />
          <Text style={[styles.label, styles.single ]}>Ingeschreven voor: {this.props.date}</Text>            
        </View>
        <View>
        <View style={styles.item}>
         <GenerateIcon name={'user-circle-o'} size={15} />
          <Text style={styles.label}>Kind(eren)</Text>
          <View style={styles.description}>
           {this.state.children !== undefined && this.state.children.length > 0 ? this.renderChildren(this.state.children, 'child_id') : null}
          </View>              
        </View>
        <View style={styles.item}>
         <GenerateIcon name={'sun-o'} size={15} />
          <Text style={styles.label}>Dag type</Text>
          <View style={styles.description}>
            {this.renderChecklist(types, 'type')}
          </View>              
        </View> 
        <View style={styles.item}>
         <GenerateIcon name={'bicycle'} size={15} />
          <Text style={styles.label}>Mag alleen naar huis.</Text>
          <View style={styles.description}>
            {this.renderChecklist(bool, 'go_home_alone')}
          </View>              
        </View>      
        <View style={styles.item}>
         <GenerateIcon name={'comment-o'} size={15} />
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


import React, { Component } from 'react';
import { Text, View, TouchableOpacity, TextInput, ScrollView } from 'react-native';
import { connect }from 'react-redux';
import { Actions } from 'react-native-router-flux';
import styles from './styles';
import moment from 'moment';
import 'moment/locale/nl-be';
import Icon  from 'react-native-vector-icons/FontAwesome';
import Colors from '../../../Config/theme';

class UpdateCalendarService extends Component {
  constructor(props) {
    super(props);
    this.state = {
      item: {},
      children: [],
      child: '', 
    }

    this.updateFollowing = {};
  }   
  
  componentDidMount() {
    this.props.fetchItem(this.props.token, this.props.id, this.props.itemId);
  }   

  componentWillReceiveProps(nextProps) {
   if (nextProps.item != null && nextProps.children.length > 0 && nextProps.error == undefined) {
      this.state.item = nextProps.item;
      this.state.children = nextProps.children;
      // give the new state the old value for placeholder.
      this.getChild(this.state.children, this.state.item.child_id)
      } 
  }

  submit = () => {
    console.log(this.props.token, this.props.id);
    this.props.updateItem(this.props.token, this.props.id, this.props.itemId, this.updateFollowing);
  }

  getChild = (children, id) => {
    children.forEach((child) => {
      if(child.id == id){
        this.state.child = child.name;
        this.state.new_child = child.id;
      }
    })
  }

  
  generateIcon = (name, size) => (
      <Icon style={styles.icon} name={name} size={size}/>
  );
  
  toPatch = (key, value) => {
    console.log(this.updateFollowing);
      if(this.updateFollowing[key] == undefined){
          this.updateFollowing[key] = value;
          console.log(this.updateFollowing);
      } else {
        this.updateFollowing[key] = value;
      }
  }
  changeIcon = (icon) => {
   
    switch(icon) {
      case 'circle-o':
       console.log(icon);
      return 'check-circle-o';
      break;
    }
  }

  render() {
    const types = [{name: 'voormiddag', value: 'morning'}, {name: 'namiddag', value: 'evening'}, {name: 'hele dag', value: 'full day'}];
    const bool = [{name: 'Mag alleen naar huis', value: true}, {name: 'Wordt opgehaald', value: false}];
    return (
     <ScrollView style={styles.container}>
      <View style={styles.item}>
        {this.generateIcon('calendar', 15)}
        <Text style={[styles.label, styles.single ]}>Ingeschreven op: {this.state.item.date}</Text>            
      </View>

      <View style={styles.item}>
        {this.generateIcon('user-circle-o', 15)}
        <Text style={styles.label}>{this.state.child}</Text>
        <View style={styles.description}>
          {this.state.children.map((child, i) => {
            let name ='circle-o';
             if(this.updateFollowing.child_id == undefined){
                if(this.state.item.child_id == child.id){
                  name = "check-circle-o";
                }
            } else {
              if(this.updateFollowing.child_id == child.id){
                 name = "check-circle-o";
              }
            }
            return (
              <TouchableOpacity style={styles.check} key={i} onPress={() => {this.toPatch('child_id', child.id), this.getChild(this.state.children, child.id)}}>
                <Icon style={styles.checkIcon} name={name} size={12}/><Text style={styles.checkText}>{child.name}</Text>
              </TouchableOpacity>)
          })}
        </View>              
      </View>
      
      <View style={styles.item}>
        {this.generateIcon('sun-o', 15)}
        <Text style={styles.label}>Ingeschreven voor {this.updateFollowing.type != undefined ?  this.updateFollowing.type : this.state.item.type}</Text>
        <View style={styles.description}>
          {types.map((type, i) => {
             let name = "circle-o";
             if(this.updateFollowing.types == undefined){
                if(this.state.item.type == type.value){
                  name = "check-circle-o";
                }
            } else {
              if(this.updateFollowing.type == type.value){
                 name = "check-circle-o";
              }
            }
            return (<TouchableOpacity style={styles.check} key={i} onPress={() => {this.toPatch('type', type.value), this.changeIcon(name)}}><Icon style={styles.checkIcon} name={name} size={12}/><Text style={styles.checkText}>{type.name}</Text></TouchableOpacity>)
          })}
        </View>              
      </View>
      <View style={styles.item}>
        {this.generateIcon('bicycle', 14)}
        <Text style={styles.label}>{this.state.go_home_alone == true ? 'Kind mag alleen naar huis': 'kind wordt opgehaald'}</Text>
        <View style={styles.description}>
          {bool.map((b, i) => {
            let conditionalStyles = [styles.check];
            let name = "circle-o";
            if(this.updateFollowing.go_home_alone == undefined){
                if(this.state.item.go_home_alone == b.value){
                  name = "check-circle-o";
                }
            } else {
              if(this.updateFollowing.go_home_alone == b.value){
                 name = "check-circle-o";
              }
            }
            return ( <TouchableOpacity style={styles.check} key={i} onPress={() => {this.toPatch('go_home_alone', b.value)}}>
              <Icon  style={styles.checkIcon} name={name} size={12}/><Text style={styles.checkText}>{b.name}</Text>
              </TouchableOpacity>)
         })}
        </View>              
      </View>

      <View style={styles.item}>
        {this.generateIcon('comment-o', 15)}
        <Text style={styles.label}>Opmerking:</Text>
        <View style={styles.description}>
          <TextInput
            style={styles.textInput}
            onChangeText={(note) => {this.toPatch('parent_notes', note)}}
            placeholder={this.updateFollowing.parent_notes == undefined? this.state.item.parent_notes: this.updateFollowing.parent_notes} />
        </View>              
      </View>
      <TouchableOpacity style={styles.btn} onPress={() => {this.submit()}}>
        <Text style={styles.btnText}>BEWAREN</Text>
      </TouchableOpacity>     
    </ScrollView>
  );
  }
}

export default connect()(UpdateCalendarService);

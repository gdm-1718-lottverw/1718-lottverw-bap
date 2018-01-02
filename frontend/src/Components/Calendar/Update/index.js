import React, { Component } from 'react';
import { Text, View, TouchableOpacity, TextInput, ScrollView } from 'react-native';
import { connect }from 'react-redux';
import { Actions } from 'react-native-router-flux';
import styles from './styles';
import moment from 'moment';
import 'moment/locale/nl-be';
import Icon  from 'react-native-vector-icons/FontAwesome';
import Colors from '../../../Config/theme';
import { RadioButtons } from 'react-native-radio-buttons'

class UpdateCalendarService extends Component {
  constructor(props) {
    super(props);
    this.state = {
      item: {},
      children: [],
      child: '', 
      child_id: '',
      type:'', 
      go_home_alone:'',
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
      this.setState({type: nextProps.item.type});
      console.log(nextProps.item.go_home_alone, nextProps.item.type);
      this.setState({go_home_alone: nextProps.item.go_home_alone});
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
         console.log('CHILD: ', child)
        
        this.state.new_child = child.id;
        this.setState({child: child.name})      
        this.setState({child_id: child.name})      
      }
    })
  }

  
  generateIcon = (name, size) => (
      <Icon style={styles.icon} name={name} size={size}/>
  );
  
  toPatch = (key, value) => {
      if(this.updateFollowing[key] == undefined){
          this.updateFollowing[key] = value;
      } else {
        this.updateFollowing[key] = value;
      }
  }

  
    
  renderChecklist = (obj, patch) => {
    setCheck = (item, patcho) => {
       var a = {backgroundColor: '#000000', height: 10, width:10, borderRadius: 7,  marginTop: 5, marginRight: 5};
       var b = {backgroundColor: '#FFFFFF', borderColor: '#000', borderWidth: 1, height: 10, width:10, borderRadius: 7, marginTop: 5, marginRight: 5};
       switch(patcho){
        case item.name: 
          return a;
          break;
        default: 
          return b;
          break;
       }
    }
                                                  
    return obj.map((item, i) => {
      if(this.updateFollowing.patch == undefined){
        if(obj.patch == item.id){
         this.setState({[patch]: item.name});
        }
      } else if(this.updateFollowing.patch == item.id){
        this.setState({[patch]: item.name});
      }
      return (
        <TouchableOpacity style={styles.check} key={i} onPress={() => {this.toPatch(patch, item.id); this.setState({[patch]: item.name})}}>
         <View style={setCheck(item, this.state[patch])}></View>
         <Text style={styles.checkText}>{item.name}</Text>
        </TouchableOpacity>)
      })
  }

  render() {
    const types = [{name: 'voormiddag', id: 'morning', checked: false}, {name: 'namiddag', id: 'evening', checked: false}, {name: 'hele dag', id: 'full day', checked: false}];
    const bool = [{name: 'Mag alleen naar huis', id: true, checked: false}, {name: 'Wordt opgehaald', id: false, checked: false}];
    return (
     <ScrollView style={styles.container} keyboardShouldPersistTaps='always' >
      <View style={styles.item}>
        {this.generateIcon('calendar', 15)}
        <Text style={[styles.label, styles.single ]}>Ingeschreven op: {this.state.item.date}</Text>            
      </View>

      <View style={styles.item}>
        {this.generateIcon('user-circle-o', 15)}
        <Text style={styles.label}>{this.state.child_id}</Text>
        <View style={styles.description}>
         {this.renderChecklist(this.state.children, 'child_id', 'id')}
        </View>              
      </View>
      
      <View style={styles.item}>
        {this.generateIcon('sun-o', 15)}
        <Text style={styles.label}>Ingeschreven voor {this.state.type}</Text>
        <View style={styles.description}>
        {this.renderChecklist(types, 'type', 'value')}
        </View>              
      </View>
      <View style={styles.item}>
        {this.generateIcon('bicycle', 14)}
        <Text style={styles.label}>{this.state.go_home_alone == true ? 'Kind mag alleen naar huis': 'kind wordt opgehaald'}</Text>
        <View style={styles.description}>
         {this.renderChecklist(bool, 'go_home_alone')}
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

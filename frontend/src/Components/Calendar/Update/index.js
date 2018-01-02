import React, { Component } from 'react';
import { Text, View, TouchableOpacity, TextInput } from 'react-native';
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

  
  generateIcon = (name) => (
      <Icon style={styles.checkboxIcon} name={name} size={20}/>
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


  render() {
    const types = [{name: 'voormiddag', value: 'morning'}, {name: 'namiddag', value: 'evening'}, {name: 'hele dag', value: 'full day'}];
    const bool = [{name: 'Mag alleen naar huis', value: true}, {name: 'Wordt opgehaald', value: false}];
    return (
     <View>
      <View style={styles.item}>
        {this.generateIcon('calendar')}
        <View style={styles.description}>
          <Text style={styles.label}>Ingeschreven op: {this.state.item.date}</Text>
        </View>              
      </View>

      <View style={styles.item}>
        {this.generateIcon('user-circle-o')}
        <View style={styles.description}>
          <Text style={styles.label}>{this.state.child}</Text>
          {this.state.children.map((child, i) => {
            return (
              <TouchableOpacity key={i} onPress={() => {this.toPatch('child_id', child.id), this.getChild(this.state.children, child.id)}}>
                <Text>{child.name}</Text>
              </TouchableOpacity>)
          })}
        </View>              
      </View>
      
      <View style={styles.item}>
        {this.generateIcon('sun-o')}
        <View style={styles.description}>
          <Text style={styles.label}>Ingeschreven voor {this.updateFollowing == undefined ?  this.updateFollowing.type : this.state.item.type}</Text>
          {types.map((type, i) => {
            return (<TouchableOpacity key={i} onPress={() => {this.toPatch('type', type.value)}}><Text>{type.name}</Text></TouchableOpacity>)
          })}
        </View>              
      </View>
      <View style={styles.item}>
        {this.generateIcon('bicycle')}
        <View style={styles.description}>
          <Text style={styles.label}>{this.state.go_home_alone == true ? 'Kind mag alleen naar huis': 'kind wordt opgehaald'}</Text>
          {bool.map((b, i) => {
            return (<TouchableOpacity key={i} onPress={() => {this.toPatch('go_home_alone', b.value)}}>
              <Text>{b.name}</Text>
              </TouchableOpacity>)
         })}
        </View>              
      </View>
      <View style={styles.item}>
        {this.generateIcon('comment-o')}
        <View style={styles.description}>
          <Text style={styles.label}>Opmerking:</Text>
          <TextInput
            style={styles.textInput}
            onChangeText={(note) => {this.setState({new_parent_note: note})}}
            value={this.state.new_parent_note}/>
        </View>              
      </View>
      <TouchableOpacity style={styles.btn} onPress={() => {this.submit()}}>
        <Text style={styles.btnText}>BEWAREN</Text>
      </TouchableOpacity>     
    </View>
    );
  }
}

export default connect()(UpdateCalendarService);

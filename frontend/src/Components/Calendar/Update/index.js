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
      icon: [],
      children: [],
      child: '', 
      new_child: '', 
      new_parent_note:'', 
      new_go_home_alone: '',
      new_type: '',
    }
  }   
  
  componentDidMount() {
    this.props.fetchItem(this.props.token, this.props.id, this.props.itemId);
  }   

  componentWillReceiveProps(nextProps) {
   if (nextProps.item != null && nextProps.children.length > 0 && nextProps.error == undefined) {
      this.state.item = nextProps.item;
      this.state.children = nextProps.children;
      // give the new state the old value for placeholder.
      this.new_parent_note = this.state.item.parent_note;
      this.getChild(this.state.children, this.state.item.child_id)

      switch(nextProps.item.type){
        case 'morning':
         return this.state.icon.push({name: 'sun-o'});
         break;
        case 'evening': 
         return this.state.icon.push({name: 'moon-o'});
         break;
        case 'full day': 
         return this.state.icon.push({name: 'moon-o'}, {name: 'sun-o'});
         break;
      }
    } 
  }

  submit = () => {
    const loop = [ this.state.new_child, this.state.new_go_home_alone, this.state.new_parent_note, this.state.new_type];
    let update = {};
    loop.forEach((item) => {
      console.log(item);
      if (item !== undefined && item != null){
        for(key in this.state){
          update[key.slice(4)] = item;

        }
        console.log('UPDATE', update, this.props);
      }

    })
  }

  getChild = (children, id) => {
    children.forEach((child) => {
      if(child.id == id){
        this.state.child = child.name;
        this.state.new_child = child.id;
      }
    })
  }

  generateIcons = (icons) => {
    return icons.map((icon, i) => {
        return (<Icon key={i} style={styles.checkboxIcon} name={icon.name} size={20}/>)
      });
  }
  generateIcon = (name) => (
      <Icon style={styles.checkboxIcon} name={name} size={20}/>
  );
  

  render() {
    const types = [{name: 'voormiddag', value: 'morning'}, {name: 'namiddag', value: 'evening'}, {name: 'hele dag', value: 'full day'}];
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
              return (<TouchableOpacity key={i} onPress={() => {this.setState({'new_child': child.id}), this.getChild(this.state.children, child.id)}}>
                  <Text>{child.name}</Text>
                </TouchableOpacity>)
            })}
          </View>              
        </View>
        <View style={styles.item}>
          {this.generateIcons(this.state.icon)}
          <View style={styles.description}>
            <Text style={styles.label}>Ingeschreven voor {this.state.new_type == ''? this.state.item.type: this.state.new_type }</Text>
            {types.map((type, i) => {
              return (<TouchableOpacity key={i} onPress={() => {this.setState({'new_type': type.value})}}>
                  <Text>{type.name}</Text>
                </TouchableOpacity>)
            })}
          </View>              
        </View>
        <View style={styles.item}>
           {this.generateIcon('bicycle')}
          <View style={styles.description}>
            <Text style={styles.label}>{this.new_go_home_alone == true? 'Kind mag alleen naar huis': 'kind wordt opgehaald'}</Text>
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

import React, { Component } from 'react';
import { Text, View, TouchableOpacity, TextInput, ScrollView } from 'react-native';
import { connect }from 'react-redux';
import { Actions } from 'react-native-router-flux';
import styles from './styles';
import moment from 'moment';
import 'moment/locale/nl-be';
import Colors from '../../../Config/theme';
import { RadioButtons } from 'react-native-radio-buttons'
import GenerateIcon from '../../Icon/index';
import GenerateLoading from '../../Loading/index'; 

class UpdateCalendarService extends Component {
  constructor(props) {
    super(props);
    this.state = {
      item: {},
      children: [],
      guardians: [], 
      go_home_alone:'',
      types: [{name: 'voormiddag', id: 'voormiddag', selected: false}, {name: 'namiddag', id: 'namiddag', selected: false}],
      bool: [{name: 'Wordt opgehaald', id: false, selected: true}, {name: 'Mag alleen naar huis', id: true, selected: false}],
 
    }
    loading = false;
    this.updateFollowing = {};
  }   
  
  componentDidMount() {
    this.props.fetchItem(this.props.token, this.props.id, this.props.itemId);
  }   

  componentWillReceiveProps(nextProps) {
   if (nextProps.item != null && nextProps.children.length > 0 && nextProps.children.length > 0 && nextProps.error == undefined) {
      this.state.item = nextProps.item;
      this.setState({go_home_alone: nextProps.item.go_home_alone});
      

      nextProps.children.forEach((child, i) => {
        child.id == this.state.item.child_id? child['selected'] = true :null;
      })
      this.setState({'children': nextProps.children}); 
      nextProps.guardians.forEach((guard, i) => {
        guard.id == this.state.item.guardian_id? guard['selected'] = true : null;
      }) 
      this.setState({'guardians': nextProps.guardians}); 
      this.state.types.forEach((type,i) => {
        type.id == this.state.item.type? type['selected'] = true: type['selected'] = false;
        console.log(type, this.state.item.type);
      })
      this.setState({'type': this.state.types}); 
      this.state.bool.forEach((b,i) => {
        b.id == this.state.item.go_home_alone? b['selected'] = true: null;
      })
      this.setState({'bool': this.state.bool}); 
      console.log(this.state.guardians, this.state.children);
      
    } 
  }

  submit = () => {
    console.log('TEST', this.updateFollowing);
    this.props.updateItem(this.props.token, this.props.id, this.props.itemId, this.updateFollowing);
  }

  toPatch = (key, value) => {
      if(this.updateFollowing[key] == undefined){
          this.updateFollowing[key] = value;
      } else {
        this.updateFollowing[key] = value;
      }
  } 

  setCheckedRadio = (item) => {
    if(item.selected == true){
      return styles.checked;
    } else {
      return styles.unChecked;
    }
  }

  setSelected = (obj, item) => {
    obj.forEach((o, i)=>{
      o.selected = false;
      if(o.name == item.name){
        o.selected = true;
      }
    })
    return obj;
  }

  renderRadioButton = (obj, patch, key) => {      
    return obj.map((item, i) => {
      return (
        <TouchableOpacity style={styles.check} key={i} onPress={() => {
            this.setSelected(obj, item);
            this.setState({[patch]: obj}); 
            console.log(item);
            this.toPatch(key, item.id)
          }}>
         <View style={this.setCheckedRadio(item)}></View>
         <Text style={styles.checkText}>{item.name}</Text>
        </TouchableOpacity>)
      })
  }

  render() {
    return (
      <ScrollView style={styles.container} keyboardShouldPersistTaps='always'>

        {this.loading == true? <View style={styles.loadingContainer}><GenerateLoading /></View>:
        <View>
          <View style={styles.item}>
            <GenerateIcon name={'calendar'} size={15} />
            <Text style={[styles.label, styles.single ]}>Ingeschreven op: {this.state.item.date}</Text>            
          </View>
          <View style={styles.item}>
            <GenerateIcon name={'user-circle-o'} size={15} />
            <Text style={styles.label}>Kind(eren)</Text>
            <View style={styles.description}>
             {this.renderRadioButton(this.state.children, 'children', 'child_id')}
            </View>
          </View>
          <View style={styles.item}>
            <GenerateIcon name={'sun-o'} size={15} />
            <Text style={styles.label}>Dag type</Text>
            <View style={styles.description}>
             {this.renderRadioButton(this.state.types, 'types', 'type')}
            </View>              
          </View>
          <View style={styles.item}>
            <GenerateIcon name={'bicycle'} size={15} />
            <Text style={styles.label}>Mag alleen naar huis.</Text>
            <View style={styles.description}>
              {this.renderRadioButton(this.state.bool, 'bool', 'go_home_alone')}
            </View>              
          </View>      
          <View style={styles.item}>
           <GenerateIcon name={'users'} size={15} />
           <Text style={styles.label}>Komt kind ophalen.</Text>
           <View style={styles.description}>
             {this.state.guardians != undefined? this.renderRadioButton(this.state.guardians, 'guardians', 'guardian_id'): null}
           </View>              
          </View>  
          <View style={styles.item}>
           <GenerateIcon name={'comment-o'} size={15} />
           <Text style={styles.label}>Opmerkingen</Text>
           <View style={styles.description}>
             <TextInput
             style={styles.textInput}
             onChangeText={(parent_notes) => {this.setState({parent_notes}, this.toPatch('parent_notes', parent_notes))}}
             value={this.state.item.parent_notes}/>
          </View>              
          <View style={styles.row}>
            <TouchableOpacity style={styles.btn} onPress={() => {this.submit()}}>
              <Text style={styles.btnText}>BEWAREN</Text>
            </TouchableOpacity>
             <TouchableOpacity style={[styles.btnDelete]} onPress={() => {this.props.deleteDate(this.props.token, this.props.id, this.props.itemId)}}>
             <Text style={styles.btnText}>DELETE</Text>
            </TouchableOpacity>
          </View>         
        </View>  
        </View>}
      </ScrollView>
    );
  }
}

export default connect()(UpdateCalendarService);

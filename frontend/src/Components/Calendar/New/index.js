import React, { Component } from 'react';
import { View, Text, ScrollView, TouchableOpacity, TextInput, Picker, Button } from 'react-native';
import { Actions } from 'react-native-router-flux';
import PropTypes from 'prop-types';
import styles from './styles';
import GenerateIcon from '../../Icon/index';
import Icon from 'react-native-vector-icons/FontAwesome';
import GenerateLoading from '../../Loading/index'; 

class NewCalendarService extends React.Component{  
  constructor(props){
    super(props);
    this.state = {
      parent_notes: '',
      date: this.props.date,
      children: [],
      guardians: [],
      error: '',
      types: [{name: 'voormiddag', id: 'voormiddag'}, {name: 'namiddag', id: 'namiddag'}],
      bool: [{name: 'Wordt opgehaald', id: false, selected: true}, {name: 'Mag alleen naar huis', id: true, selected: false}],
    }
    var loading = true;
  }

  componentDidMount() {
    this.props.fetchChildren(this.props.token, this.props.id);
  }   

  componentWillReceiveProps(nextProps) {
   if (nextProps.error == undefined) {
      this.setState({'children': nextProps.data['children']});
      this.setState({'guardians': nextProps.data['guardians']});
      this.loading = false;
    } 
  }
  
  renderCheckBoxes = (obj, patch) => {
    return obj.map((item, i) => {
      return (
        <TouchableOpacity style={styles.check} key={i} onPress={() => {
          this.setCheckBoxSelected(this.state[patch][i]);
          this.setState({[patch]: obj})
        }}>
         <View style={this.setCheckedRadio(this.state[patch][i])}></View>
         <Text style={styles.checkText}>{item.name}</Text>
        </TouchableOpacity>)
      })
  }

  setCheckBoxSelected = (item) => {
    if(item['selected'] == undefined){
      item['selected'] = true;
    } else {
      item['selected'] = !item['selected'];
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
      //o.id = false;
      if(o.name == item.name){
        o.selected = true;
        //o.id = true;
      }
    })
    return obj;
  }

  renderRadioButton = (obj, patch) => {      
    return obj.map((item, i) => {
      return (
        <TouchableOpacity style={styles.check} key={i} onPress={() => {
            this.setSelected(obj, item);
            this.setState({[patch]: obj}); 
          }}>
         <View style={this.setCheckedRadio(item)}></View>
         <Text style={styles.checkText}>{item.name}</Text>
        </TouchableOpacity>)
      })
  }

  submit = () => {
    let children = [];
    this.state.children.forEach((e) => {
      e.selected == true? children.push(e.id): null;
    })
    let types = [];
    this.state.types.forEach((e) => {
     e.selected == true? types.push(e.id): null;
    })
    let home = false;
    this.state.types.forEach((e) => {
     e.selected == true? home = e.id: null;
    })
    let guardians = null;
    this.state.guardians.forEach((e) => {
      console.log(this.state.guardians);
      e.selected == true? guardians = e.id: null;
    })    

    let data = {
      child_id: children,
      date: this.state.date,
      parent_notes: this.state.parent_notes,
      types: types, 
      go_home_alone: home,
      guardian_id: guardians
    };
    console.log(data);
    if (children.length == 0 && types.length == 0){
      this.setState({error: "U heeft geen kinderen noch dag types gekozen."});
    } else if(children.length == 0){
      this.setState({error: "Gelieve minimum één kind aan te duiden."});
    } else if(types.length == 0){
      this.setState({error: "Gelieve een dag type aan te duiden."});
    } else {
      this.loading = true;
      this.setState({error: ''});
      this.props.submitNewAttendance(this.props.token, this.props.id, JSON.stringify(data));
    }
  }

  render(){  
    return (
      <ScrollView style={styles.container}>
       
        {this.loading == true? <View style={styles.loadingContainer}><GenerateLoading /></View>:
          <View>
          {this.state.error != ''? 
          <View style={styles.error}>
            <Icon style={styles.errorIcon}  name={'exclamation-triangle'} size={14}/>
            <Text style={styles.errorText}>{this.state.error}</Text>
          </View>
        :null}
        <View style={styles.item}>
          <GenerateIcon name={'calendar'} size={15} />
          <Text style={[styles.label, styles.single ]}>Ingeschreven voor: {this.props.date}</Text>            
        </View>
        <View>
        <View style={styles.item}>
         <GenerateIcon name={'user-circle-o'} size={15} />
          <Text style={styles.label}>Kind(eren)</Text>
          <View style={styles.description}>
           {this.state.children !== undefined && this.state.children.length > 0 ? this.renderCheckBoxes(this.state.children, 'children') : null}
          </View>              
        </View>
        <View style={styles.item}>
         <GenerateIcon name={'sun-o'} size={15} />
          <Text style={styles.label}>Dag type</Text>
          <View style={styles.description}>
            {this.renderCheckBoxes(this.state.types, 'types')}
          </View>              
        </View> 

        <View style={styles.item}>
         <GenerateIcon name={'bicycle'} size={15} />
          <Text style={styles.label}>Mag alleen naar huis.</Text>
          <View style={styles.description}>
            {this.renderRadioButton(this.state.bool, 'bool')}
          </View>              
        </View>     


        <View style={styles.item}>
         <GenerateIcon name={'users'} size={15} />
          <Text style={styles.label}>Komt kind ophalen.</Text>
          <View style={styles.description}>
            {this.state.guardians != undefined? this.renderRadioButton(this.state.guardians, 'guardians'): null}
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
                </View>
        }
      </ScrollView>
      );

  }
}

NewCalendarService.propTypes = {
  date: PropTypes.string,
}

    
export default NewCalendarService;


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
    }
  }   
  
  componentDidMount() {
    this.props.fetchItem(this.props.token, this.props.id, this.props.itemId);
  }   

  componentWillReceiveProps(nextProps) {
    console.log(nextProps);
   if (nextProps.item != undefined || nextProps.item != null && nextProps.error == undefined) {
      this.state.item = nextProps.item;
    } 
  }


  render() {
    console.log(this.state.item, this.state.item.go_home_alone);
    return (
      <View>
        <Text style={styles.label}>Child {this.state.item.date}</Text>
        <Text style={styles.label}>Type {this.state.item.type}</Text>
        <Text style={styles.label}>go_home_alone {this.state.item.go_home_alone}</Text>
        <TextInput
          style={styles.textInput}
          onChangeText={(child) => {this.setState({item})}}
          value={this.state.item.parent_notes}/>
      </View>
    );
  }
}

export default connect()(UpdateCalendarService);

import React, { Component } from 'react';
import { Text, View, } from 'react-native';
import { connect }from 'react-redux';
import { Calendar, CalendarList, Agenda } from 'react-native-calendars';
import { Actions } from 'react-native-router-flux';
import styles from './styles';
import moment from 'moment';

class CalendarService extends Component {
  constructor(props) {
    super(props);
    this.state = {
      data: [],
      items: {},
      dates: {},
      newDate: '',
    }
  }   
  
  componentDidMount() {
    this.props.fetchDates(this.props.token, this.props.id);
  }   

  componentWillReceiveProps(nextProps) {
   if (nextProps.data.length > 0 && nextProps.error == undefined) {
      this.state.data = nextProps.data;
      this.getMarkedDates(nextProps.data);
    } 
  }

  getMarkedDates = (data) => {
    let items = {}
    let marker = {};
    let dots = []; 
    let dot = {};
    let children = {};
    colors = ['red', 'blue', 'green', 'orange', 'purple'];
    a = 0;
    data.forEach((e, i) => {
      if(children[e.child] == undefined){
        children[e.child] = colors[a];
        a++;
      }

      dot = { key: i, color: children[e.child], marked: true };
      marker[e.date] == undefined? marker[e.date] = {dots: [dot]} : marker[e.date]['dots'].push(dot);
      
      if(items[e.date] == undefined){
        let item = {name: e.child + ' ingeschreven op ' + e.type}

        items[e.date] = [];
        items[e.date].push(item);
      } else {
        let item = {name: e.child + ' ingeschreven op ' + e.type}
        items[e.date].push(item);
      }
    });    
    this.state.items = items;
    this.state.dates = marker;
  }
  render() {
    return (
      <Agenda
        items={this.state.items}
        loadItemsForMonth={this.loadItems.bind(this)}
        selected={moment().format()  }
        renderItem={this.renderItem.bind(this)}
        rowHasChanged={this.rowHasChanged.bind(this)}
        markingType={'multi-dot'}
        markedDates={this.state.dates} />

    );

  }


  loadItems(day) {
     setTimeout(() => {
      const newItems = {};
      Object.keys(this.state.items).forEach(key => {newItems[key] = this.state.items[key];});
      this.setState({
        items: newItems
      });
      }, 1000);
  }

  renderItem(item, i) {
    console.log(item, i, a);
    return (
      <View style={[styles.item]}><Text>{item.name}</Text></View>
    );
  }

  rowHasChanged(r1, r2) {
    return r1.name !== r2.name;
  }

  timeToString(time) {
    const date = new Date(time);
    return date.toISOString().split('T')[0];
  }
}

export default connect()(CalendarService);
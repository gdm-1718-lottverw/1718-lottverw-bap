import React, { Component } from 'react';
import { Text, View, } from 'react-native';
import { connect }from 'react-redux';
import { Calendar, CalendarList, Agenda } from 'react-native-calendars';
import { Actions } from 'react-native-router-flux';
import styles from './styles';

class CalendarService extends Component {
  constructor(props) {
    super(props);
    this.state = {
      data: [],
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
      console.log('children: ', children, a);

      dot = { key: i, color: children[e.child], marked: true };
      marker[e.date] == undefined? marker[e.date] = {dots: [dot]} : marker[e.date]['dots'].push(dot);
      console.log(marker);

    })
    this.state.dates = marker;
  }
  render() {
    return (

    <Calendar
      onDayPress={(day) => {
        console.log('DAY', day);
        this.state.newDate = day.day + '/'+ day.month + '/' + day.year;
        Actions.quickAdd({'date': this.state.newDate});
      }}
      markingType={'multi-dot'}
      markedDates={this.state.dates} />
    );
  }
}

export default connect()(CalendarService);
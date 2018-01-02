import React, { Component } from 'react';
import { Text, View, TouchableOpacity } from 'react-native';
import { connect }from 'react-redux';
import { Calendar, CalendarList, Agenda } from 'react-native-calendars';
import { Actions } from 'react-native-router-flux';
import styles from './styles';
import 'moment/locale/nl-be';
import moment from 'moment';
import Icon  from 'react-native-vector-icons/FontAwesome';
import Colors from '../../Config/theme';

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
    colors = [ Colors.lightBlue, Colors.darkBlue, Colors.green, Colors.yellow, Colors.pink, Colors.purple];
    a = 0;
    data.forEach((e, i) => {
      if(children[e.child] == undefined){
        children[e.child] = colors[a];
        a++;
      }

      dot = { key: i, color: children[e.child], marked: true };
      marker[e.date] == undefined? marker[e.date] = {dots: [dot]} : marker[e.date]['dots'].push(dot);
      let item = {child: e.child, description: 'Ingeschreven voor de ' + e.type, id: e.id, color: children[e.child], note: e.note, date: e.date}
      if(items[e.date] == undefined){
        items[e.date] = [];
        items[e.date].push(item);
      } else {
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
        minDate={moment().format()}
        loadItemsForMonth={this.loadItems.bind(this)}
        theme={{  
          agendaTodayColor: Colors.deeppink,
          agendaKnobColor: Colors.deeppink, 
          selectedDayBackgroundColor: Colors.gray,
          selectedDayTextColor: Colors.darkgrey
        }}
        pastScrollRange={1}
        current={moment().format()}
        onDayPress={(date) => {Actions.quickAdd({'date': date.dateString})}}
        renderItem={this.renderItem.bind(this)}
        rowHasChanged={this.rowHasChanged.bind(this)}
        markingType={'multi-dot'}
        markedDates={this.state.dates} />

    );

  }


  loadItems(day) {
     setTimeout(() => {
      }, 1000);
  }

  renderItem(item) {
    return (
      <View>
        <View style={styles.item}>
          <View style={styles.text}>
            <View style={{flex: 1, flexDirection: 'row'}}>
            <View style={{height:10, width: 10, marginRight: 5, marginTop: 6, backgroundColor: item.color, borderRadius: 50}}></View>
            <Text style={styles.child}>{item.child}</Text>
            </View>
            <Text style={styles.description}>{item.description}</Text>
          </View>
          <View style={styles.actions}>
            <TouchableOpacity style={styles.action} onPress={() => {Actions.updateCalendar({'itemId': item.id, 'date': item.date})}}>
              <Icon name='pencil' size={20}/>
            </TouchableOpacity>
             <TouchableOpacity style={styles.action} onPress={() => {this.props.deleteDate(this.props.token, this.props.id, item.id)}}>
              <Icon name='trash' size={20}/>
            </TouchableOpacity>
          </View>
        </View>
          {item.note != ''? <Text style={styles.note}>{item.note}</Text>: null}
      </View>
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
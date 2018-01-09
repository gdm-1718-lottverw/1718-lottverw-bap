import React, { Component } from 'react';
import { StyleSheet, Text, ScrollView, View, ActivityIndicator, TextInput,ListView,  TouchableOpacity } from 'react-native';
import { connect }from 'react-redux';
import Icon from 'react-native-vector-icons/FontAwesome';
import styles from './styles';
import moment from 'moment';
import 'moment/locale/nl-be';
import Colors from '../../Config/theme';

class HistoryService extends Component {
  constructor(props) {
        super(props);
        moment.locale('nl-be');
    
        this.state = {
          data: []
        };   
    }
  
    componentDidMount() {
        this.props.fetchHistory(this.props.token, this.props.id);
    }   

  componentWillReceiveProps(nextProps) {
    if (nextProps.data.length > 0 && nextProps.error == undefined) {
      this.setState({
        data: nextProps.data,
      });
      console.log(this.state.data);
    }
  }

  render() {
        return (
          <ScrollView style={styles.container}>
            {this.state.data != undefined? this.state.data.map((a, i) => {
              return (
                <View key={i} style={[styles.column, styles.item]}>
                  {a.in == 0 && a.out == 0? 
                    <View style={[styles.row, styles.alert]}>
                      <Icon style={[styles.icon, styles.mRight, styles.red, styles.mTop]} name={'exclamation-triangle'} size={16}/>
                      <Text style={[styles.bold]}>Kind ingeschreven maar niet geweest.</Text>
                      <Text style={[styles.center, styles.description]}>Inschrijving voor een {a.type} op {moment(a.date).format('dd DD, MMM Y')} voor {a.name}</Text> 
                    </View> : 
                    <View style={[styles.mTop]}>  
                      <Text style={[styles.center, styles.description]}>Inschrijving voor een {a.type} op {moment(a.date).format('dd DD, MMM Y')} voor {a.name}  </Text> 
                    </View> }
                </View>
              );
            }): null}
          </ScrollView>
        );
    }
}

export default connect()(HistoryService);
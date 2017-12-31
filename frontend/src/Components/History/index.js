import React, { Component } from 'react';
import { Text, View } from 'react-native';
import { connect }from 'react-redux';

import styles from './styles';
import moment from 'moment';
import Colors from '../../Config/theme';

class HistoryService extends Component {
  constructor(props) {
    super(props);
    
    this.state = {
      data: {},
    }
  }   
  
  componentDidMount() {
    this.props.fetchHistory(this.props.token, this.props.id);
  }   

  componentWillReceiveProps(nextProps) {
   if (nextProps.data.length > 0 && nextProps.error == undefined) {
      this.state.data = nextProps.data;
    } 
  }

  render() {
    return (
      <View>
        <Text>History Page</Text>
      </View>
    );
  }
}

export default connect()(HistoryService);
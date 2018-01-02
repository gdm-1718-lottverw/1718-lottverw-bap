import React, { Component } from 'react';
import { StyleSheet, View, TouchableOpacity, Text } from 'react-native';
import { connect } from 'react-redux';
import Colors from '../../Config/theme';
import TopBar from '../../Components/TopBar/index';
import { Actions } from 'react-native-router-flux';
import Icon  from 'react-native-vector-icons/FontAwesome';
import UpdateCalendarService from '../../Actions/Calendar/UpdateCalendarActions';
import PropTypes from 'prop-types';

class UpdateCalendarScreen extends React.Component{  
    constructor(props){
        super(props);
    }

  render(){  
    return (
      <View style={styles.box}>
          <TopBar title={'Pas inschrijving aan'} icon={'times'} pop={true}/>
          <UpdateCalendarService itemId={this.props.itemId} date={this.props.date} />
      </View>
    )

  }
}

UpdateCalendarScreen.propTypes = {
  itemId: PropTypes.number.isRequired,
  date: PropTypes.string.isRequired
}

const styles = StyleSheet.create({
    box: {
        flex: 1,
    },
});
    
export default UpdateCalendarScreen;

import React, { Component } from 'react';
import { StyleSheet, View } from 'react-native';
import { connect } from 'react-redux';
import Colors from '../../Config/theme';
import TopBar from '../../Components/TopBar/index';
import { Actions } from 'react-native-router-flux';
import NewCalendarService from '../../Actions/Calendar/NewCalendarActions';
import PropTypes from 'prop-types';

class NewCalendarScreen extends React.Component{  
    constructor(props){
        super(props);
        this.state = {
          children: [],
        }
    }

  render(){  
    return (
      <View style={styles.box}>
          <TopBar title={'Inschrijving'} icon={'times'} pop={true}/>
          <NewCalendarService date={this.props.date} />
      </View>
    )

  }
}

NewCalendarScreen.propTypes = {
  date: PropTypes.string
}

const styles = StyleSheet.create({
    box: {
        flex: 1,
    }
});
    
export default NewCalendarScreen;


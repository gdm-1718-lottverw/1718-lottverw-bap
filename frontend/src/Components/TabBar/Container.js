import React, { Component } from 'react';
import { View, Text } from 'react-native';
import Tabs from 'react-native-tabs';
import Icon  from 'react-native-vector-icons/FontAwesome';
import styles from './styles';
import TabBarItem from './Item';
import PropTypes from 'prop-types';

import Home from './../../Screens/Home';
import Calendar from './../../Screens/Calendar';
import History from './../../Screens/History';
import Profile from './../../Screens/Profile';

class TabBarContainer extends React.Component {     
    constructor(props){
        super(props);
        this.screen = <Home />
        console.log(this.screen)
      }   
  render(){
      return (
        <View style={styles.container}>
        { this.screen }
        <Tabs
            onSelect ={comp => {
                console.log(comp.props.name)
                switch(comp.props.name){
                    case 'home':
                      this.screen = <Home />
                      break;
                    case 'calendar':
                      this.screen = <Calendar />
                      break;
                    case 'user':
                      this.screen = <Profile />
                      break;
                    case 'history':
                      this.screen = <History />
                      break;
                    default:
                      this.screen = <Home />
                      break;
                  }
                this.props.onTabChange(comp.props.name);
            }}
            selectedStyle={styles.active}
        >
            <TabBarItem name="home" icon="home" />
            <TabBarItem name="calendar" icon="calendar" />
            <TabBarItem name="history" icon="history" />
            <TabBarItem name="user" icon="user" />
        </Tabs>
        </View>
    );
  }
}
TabBarContainer.propTypes = {
    onTabChange: PropTypes.func.isRequired
}

  export default TabBarContainer;
import React from 'react';
import { TabNavigator } from 'react-navigation';
import { StyleSheet } from 'react-native';
import  Icon  from 'react-native-vector-icons/FontAwesome';

import  Colors from './theme';
import  Home  from '../screens/Home';
import  Profile  from '../screens/Profile';
import  Calendar  from '../screens/Calendar';
import  History  from '../screens/History';

import practiceContainer from '../containers/practiceContainer';
const styles = StyleSheet.create({
    tabBar: {
        backgroundColor:  Colors.darkBlue,
    },
    icon: {
        color: Colors.white,
    },
    indicator: {
        backgroundColor: Colors.lightBrown,
    }
});
const Tabs = TabNavigator({
    Home: {
        screen: Home,
        navigationOptions: {
            tabBarIcon: ({ tintColor }) => <Icon style={styles.icon} name={'home'} size={20}/>
          },
      },
    Calender: {
        screen: Calendar,
        navigationOptions: {
            tabBarIcon: ({ tintColor }) => <Icon style={styles.icon} name={'calendar'} size={20}/>
        },
    },
    History: {
        screen: History,
        navigationOptions: {
            tabBarIcon: ({ tintColor }) => <Icon style={styles.icon} name={'history'} size={20}/>
        },
    },
    Profile: {
        screen: practiceContainer,
        navigationOptions: {
            tabBarIcon: ({ tintColor }) => <Icon style={styles.icon} name={'user'} size={20}/>
        },
    }
},
{
    tabBarPosition: 'bottom',
    swipeEnabled: true,
    animationEnabled: true,
    tabBarOptions: {
        style: styles.tabBar,
        indicatorStyle: styles.indicator,
        showLabel: false,
        showIcon: true,
    }    
});



export default Tabs;
import { } from './pages/HomeScreen';
import React, { Component } from 'React';
import { View, Text, StyleSheet, Button } from 'react-native';
import { TabNavigator } from 'react-navigation';
import Ionicons from 'react-native-vector-icons/Ionicons';
import { HomeScreen } from './src/pages/HomeScreen';

const Home = () => (
    <HomeScreen/>
  ); 
const HistoryScreen = () => (
  <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
    <Text>History Screen</Text>
  </View>
);
const CalendarScreen = () => (
  <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
    <Text>Calendar Screen</Text>
  </View>
);

const ProfileScreen = () => (
  <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
    <Text>Profile Screen</Text>
  </View>
);
const Tabs = TabNavigator({
    Home: {
        screen: Home,
        navigationOptions: {
            //tabBarLabel: 'Home',
            tabBarIcon: ({ tintColor, focused }) => (
              <Ionicons
                name={focused ? 'home' : 'home'}
                size={26}
                style={{ color: tintColor }}
              />
            ),
          },
          
      },
      Calender: {
        screen: CalendarScreen,
        navigationOptions: {
            tabBarLabel: 'Calendar',
            tabBarIcon: ({ tintColor, focused }) => (
              <Ionicons
                name={focused ? 'ios-person' : 'ios-person-outline'}
                size={26}
                style={{ color: tintColor }}
              />
            ),
          },
      },
      Histroy: {
        screen: HistoryScreen,
        navigationOptions: {
            tabBarLabel: 'History',
            tabBarIcon: ({ tintColor, focused }) => (
              <Ionicons
                name={focused ? 'ios-person' : 'ios-person-outline'}
                size={26}
                style={{ color: tintColor }}
              />
            ),
          },
      },
      Profile: {
        screen: ProfileScreen,
        navigationOptions: {
            tabBarLabel: 'Profile',
            tabBarIcon: ({ tintColor, focused }) => (
              <Ionicons
                name={focused ? 'ios-person' : 'ios-person-outline'}
                size={26}
                style={{ color: tintColor }}
              />
            ),
          },
      },
  }, {
    tabBarPosition: 'bottom',
    swipeEnabled: true,
    animationEnabled: true
  });

  

export default Tabs;
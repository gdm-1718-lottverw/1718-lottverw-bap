import React, { Component } from 'React';
import { View, Text, StyleSheet, Button } from 'react-native';
import { TabNavigator } from 'react-navigation';
import Ionicons from 'react-native-vector-icons/Ionicons';
const HomeScreen = () => (
  <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
    <Text>Home Screen</Text>
  </View>
);

const ProfileScreen = () => (
  <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
    <Text>Profile Screen</Text>
  </View>
);
const Tabs = TabNavigator({
    Home: {
        screen: HomeScreen,
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
  });

  

export default Tabs;


{/*
export default class Appy extends Component {
    render(){
        return(
        <View style={styles.container}>
            <Text>Profile</Text>
          </View>
        )
    }
}

const styles = StyleSheet.create({
    container: {
        backgroundColor: '#efefef',
        flex: 1,
        alignItems: 'center',
        justifyContent: 'center',
    }
}) */}
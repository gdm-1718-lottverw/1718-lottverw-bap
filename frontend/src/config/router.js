import React from 'react';
import { TabNavigator } from 'react-navigation';

import  Home  from '../screens/Home';
import  List  from '../screens/List';

const Tabs = TabNavigator({
    Home: {
        screen: Home,
        navigationOptions: {
            tabBarLabel: 'Home'
          },
      },
      Calender: {
        screen: List,
        navigationOptions: {
            tabBarLabel: 'List'
        },
    }
    },{
    tabBarPosition: 'bottom',
    swipeEnabled: true,
    animationEnabled: true
    },
);

export default Tabs;
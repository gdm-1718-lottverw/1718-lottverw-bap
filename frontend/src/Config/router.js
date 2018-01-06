import React, { Component } from 'react';
import ReactNativeRouter, { Actions, Router, Scene, Reducer, Modal } from 'react-native-router-flux';
import { connect } from 'react-redux';
import Colors from './theme';
import Icon  from 'react-native-vector-icons/FontAwesome';
import { View } from 'react-native';

import CalendarScreen from '../Screens/Calendar/Calendar';
import History from '../Screens/History';
import Profile from '../Screens/Profile';
import NewCalendarScreen from '../Screens/Calendar/NewCalendarScreen';
import UpdateCalendarScreen from '../Screens/Calendar/UpdateCalendarScreen';
import Login from '../Screens/Login';
import TabIcon from '../Components/TabIcon';
const reducerCreate = params => {
    const defaultReducer = new Reducer(params);
    return (state, action) => {
      return defaultReducer(state, action);
    };
  };
  
  const navigator = () => (
    <Router createReducer={reducerCreate} >
        <Scene key="root" tabBarPosition='bottom'>
            <Modal key="quickAdd">
                <Scene   
                    key="quickAdd"
                    hideNavBar={true}
                    component={NewCalendarScreen}  />
            </Modal>
            <Modal key="updateCalendar">
                <Scene   
                    key="updateCalendar"
                    hideNavBar={true}
                    component={UpdateCalendarScreen}  />
             </Modal>
            <Scene
                initial={true}
                key="login"
                component={Login}
                hideNavBar={true}/>
            <Scene 
                key="tabbar"
                lazy={true}
                tabs={true}
                hideNavBar={true}
                swipeEnabled={false}
                activeBackgroundColor={Colors.deeppink}
                labelStyle={{display: 'none'}}
                activeTintColor={Colors.white}
                tabBarStyle={{ backgroundColor: Colors.white }}>
                <Scene
                    iconName="calendar"
                    tabBarLabel=" "
                    icon={TabIcon}
                    key="calendar"
                    hideNavBar={true}
                    backToInitial={Actions.refresh()}
                    component={CalendarScreen}/>
                <Scene
                    key="history"
                    tabBarLabel=" "
                    iconName="history"
                    icon={TabIcon}
                    hideNavBar={true}
                    backToInitial={Actions.refresh()}
                    component={History}/>
                <Scene
                    key="profile"
                    iconName="user"
                    icon={TabIcon}
                    tabBarLabel=" "
                    hideNavBar={true}
                    backToInitial={Actions.refresh()}
                    component={Profile}/>
            </Scene>
        </Scene>
    </Router>
  );
  export default navigator;
  
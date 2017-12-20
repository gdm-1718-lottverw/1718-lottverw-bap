import React, { Component } from 'react';
import ReactNativeRouter, { Actions, Router, Scene, Reducer } from 'react-native-router-flux';
import { connect } from 'react-redux';
import Colors from './theme';
import Icon  from 'react-native-vector-icons/FontAwesome';
import { View } from 'react-native';
import Home from '../Screens/Home';
import CalendarScreen from '../Screens/Calendar';
import History from '../Screens/History';
import Profile from '../Screens/Profile';
import QuickAdd from '../Screens/QuickAdd';
import Login from '../Screens/Login';
import TabIcon from '../Components/TabIcon';
const reducerCreate = params => {
    const defaultReducer = new Reducer(params);
    return (state, action) => {
      return defaultReducer(state, action);
    };
  };
  
  const navigator = () => (
    <Router
    createReducer={reducerCreate}
    >
    <Scene key="root"
        tabBarPosition='bottom'>
    <Scene 
        key='login' 
        component={Login}
        hideNavBar={true}
    />
    <Scene 
        key="tabbar"
        tabs={true}
        hideNavBar={true}
        swipeEnabled={false}
        activeBackgroundColor={Colors.deeppink}
        labelStyle={{display: 'none'}}
        activeTintColor={Colors.white}
        tabBarStyle={{ backgroundColor: Colors.white }}>
        <Scene icon={TabIcon} tabBarLabel=" " iconName="home" key="actions">
            <Scene
                initial={true}
                key="home"
                component={Home}
                hideNavBar={true}
                />
                <Scene
                    key="quickAdd"
                    hideNavBar={true}
                    component={QuickAdd}  
                />
        </Scene>
        <Scene
                iconName="calendar"
                tabBarLabel=" "
                icon={TabIcon}
                key="calendar"
                hideNavBar={true}
                component={CalendarScreen}
            />
        <Scene
                key="history"
                tabBarLabel=" "
                iconName="history"
                icon={TabIcon}
                hideNavBar={true}
                component={History}
            />
        <Scene
                key="profile"
                iconName="user"
                icon={TabIcon}
                tabBarLabel=" "
                hideNavBar={true}
                component={Profile}
            />
       </Scene>
        </Scene>
    </Router>
  );
  export default navigator;
  
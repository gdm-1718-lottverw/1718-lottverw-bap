import React, { Component } from 'react';
import { StyleSheet, View, Text, ScrollView } from 'react-native';
import Colors from '../Config/theme';
import TopBar from '../Components/TopBar/index';
import ChildCard from '../Components/Home/ChildCard/index';

import ServiceAction from '../Actions/Home/serviceCallAction';
class Home extends React.Component{  
render(){  
      return (
        <View style={styles.box}>
            <TopBar title={'HOME'}/>
            <ServiceAction />
        </View>
      )

  }
}

const styles = StyleSheet.create({
    box: {
        flex: 1,
    },
});
    
export default Home;


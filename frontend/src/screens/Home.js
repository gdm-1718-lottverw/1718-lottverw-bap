import React, { Component } from 'react';
import { StyleSheet, View, Text, ScrollView } from 'react-native';
import { connect } from 'react-redux';
import Colors from '../Config/theme';
import TopBar from '../Components/TopBar/index';
import ChildCard from '../Components/Home/ChildCard/index';
import ServiceAction from '../Actions/Home/ChildCallAction';
import BottomRight  from '../Components/Button/bottomRight';
class Home extends React.Component{  
    constructor(props){
        super(props);
        
    }
render(){  
      return (
        <View style={styles.box}>
            <TopBar title={'HOME'}/>
            <ServiceAction />
            <BottomRight name={'plus'}/>
        </View>
      )

  }
}
const styles = StyleSheet.create({
    box: {
        flex: 1,
    },
});
    
export default connect()(Home);

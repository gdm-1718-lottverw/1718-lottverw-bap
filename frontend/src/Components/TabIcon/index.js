import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {
  Text, View
} from 'react-native';

import Icon from 'react-native-vector-icons/FontAwesome';
import Colors from '../../Config/theme';

const propTypes = {
  selected: PropTypes.bool,
  iconName: PropTypes.string,
};

const TabIcon = (props) => {
  return (
  <View style={{marginTop: 5, flex: 1, flexDirection:'column', alignItems:'center', alignSelf:'center', justifyContent: 'center'}}>
    <Icon style={{color: props.focused ? Colors.white : Colors.darkgrey }} name={props.iconName || "circle"} size={20}/>
  </View>
  );
}

TabIcon.propTypes = propTypes;

export default TabIcon;
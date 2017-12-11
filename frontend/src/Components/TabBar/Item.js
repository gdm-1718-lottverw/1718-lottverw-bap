import React, { Component } from 'react';
import { View, Text } from 'react-native';
import Tabs from 'react-native-tabs';
import Icon  from 'react-native-vector-icons/FontAwesome';
import styles from './styles';
import PropTypes from 'prop-types';
const TabBarItem = (props) => (
    <View>
      <Icon style={styles.icon} name={props.icon}  size={20}/>
    </View>
)
TabBarItem.propTypes = {
    icon: PropTypes.string.isRequired,
    selected: PropTypes.bool,
}
export default TabBarItem;

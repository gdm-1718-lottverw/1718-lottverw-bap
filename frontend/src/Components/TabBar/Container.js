import React, { Component } from 'react';
import { View, Text } from 'react-native';
import Tabs from 'react-native-tabs';
import Icon  from 'react-native-vector-icons/FontAwesome';
import styles from './styles';
import TabBarItem from './Item';
import PropTypes from 'prop-types';

const TabBarContainer = (props) => (
    <Tabs
        onSelect ={comp => {
            props.onTabChange(comp.props.name);
            
        }}
        selectedStyle={styles.active}
    >
        <TabBarItem name="home" icon="home" />
        <TabBarItem name="calendar" icon="calendar" />
        <TabBarItem name="history" icon="history" />
        <TabBarItem name="user" icon="user" />
    </Tabs>
)
TabBarContainer.propTypes = {
    onTabChange: PropTypes.func.isRequired
}

export default TabBarContainer;

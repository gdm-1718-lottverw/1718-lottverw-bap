import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {
  Text, View
} from 'react-native';

import Icon from 'react-native-vector-icons/FontAwesome';
import Colors from '../../Config/theme';

//Create a dedicated class that will manage the tabBar icon
class TabIcon extends Component {
  render() {
    var color = this.props.selected ? Colors.white : Colors.darkgrey;

    return (
      <View style={{marginTop: 8, flex:1, flexDirection:'column', alignItems:'center', alignSelf:'center', justifyContent: 'center'}}>
        <Icon style={{color: color}} name={this.props.iconName || "circle"} size={20}/>
      </View>
    );
  }
}
export default TabIcon;
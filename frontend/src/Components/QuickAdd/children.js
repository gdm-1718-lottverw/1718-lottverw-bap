import React, { Component } from 'react';
import { View, Text, ScrollView, Button, TextInput, Picker } from 'react-native';
import { Actions } from 'react-native-router-flux';
import PropTypes from 'prop-types';
import styles from './styles';

class ChildrenService extends React.Component{  
    constructor(props){
    super(props);

    this.state = {
      selectedItems: [],
    };

  }

  onSelectedItemsChange = selectedItems => {
    this.setState({ selectedItems });
  };

  clickme = () => {
    console.log('clicked');
  }

  render() {
    return (
      <View style={{ flex: 1, backgroundColor: 'red' }}>
        {
          this.props.children.map((child, i) => {
            return <Button key={i} onPress={this.clickme} title={child.name} />;
          })
        }
      </View>
    );
  }
}

ChildrenService.propTypes = {
  children: PropTypes.array
}

    
export default ChildrenService;


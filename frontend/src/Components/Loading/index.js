import React, {Component} from 'react';
import {
  ActivityIndicator, View
} from 'react-native';

import Colors from '../../Config/theme';


const GenerateLoading = (props) => {
  return (
      <View>
        <ActivityIndicator style={styles.loading} size="large" color={Colors.darkgrey} />
      </View>
  );
}


export default GenerateLoading;
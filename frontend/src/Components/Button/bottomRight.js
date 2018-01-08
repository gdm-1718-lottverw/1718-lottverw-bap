import React from 'react';
import {TouchableOpacity} from 'react-native';
import styles from './styles';
import Icon  from 'react-native-vector-icons/FontAwesome';
import { Actions } from 'react-native-router-flux';

const BottomRight = (props) => (
    <TouchableOpacity
        style={styles.container}
        onPress={() => Actions.quickAdd()}
      >
      <Icon style={styles.icon} name={props.name} size={20}/>
    </TouchableOpacity>
);

export default BottomRight;

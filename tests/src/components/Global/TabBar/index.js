import React, {Component} from 'React';
import { Text, View } from 'react-native';
import TabNavigator from 'react-native-tab-navigator';
import styles from './styles';
import Icon  from 'react-native-vector-icons/FontAwesome';

const TabBar = () => {
  <Tabs>
    <Icon style={styles.icon} name={'home'} size={20}/>
    <Icon style={styles.icon} name={'calendar'} size={20}/>
    <Icon style={styles.icon} name={'history'} size={20}/>
    <Icon style={styles.icon} name={'person'} size={20}/>
 </Tabs>
}
  
export default TabBar;
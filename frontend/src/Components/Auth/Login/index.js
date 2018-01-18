import React, { Component } from 'react';
import { Text, View, TextInput, TouchableOpacity } from 'react-native';
import { connect }from 'react-redux';
import { Actions } from 'react-native-router-flux';
import styles from './styles';
import Colors from '../../../Config/theme';
import GenerateLoading from '../../Loading/index';

class LoginService extends Component {
  constructor(props) {
    super(props);
    this.state = {
      username: '',
      password: '',
    }
    error = "";
    loading = false;
    errorActive = false;
  }
  componentDidMount() {}   
  componentWillReceiveProps(nextProps) {
    if(nextProps.error != undefined){
      this.error = nextProps.error;
      this.errorActive = true;
    } 
  }
  
      render() {
        return (
          <View style={styles.container}>
          {this.errorActive == true ? <Text style={styles.error}>{this.error}</Text> : null}
          {this.loading == true && this.errorActive == false? <GenerateLoading />:<View>
             <View style={styles.container}>
            <Text style={styles.label}>username</Text>
            <TextInput
                style={styles.textInput}
                underlineColorAndroid={Colors.darkgrey}
                onChangeText={(username) => {this.setState({username})}}
                value={this.state.username}/>

            <Text style={styles.label}>password</Text>
            <TextInput
                style={styles.textInput}
                underlineColorAndroid={Colors.darkgrey}
                secureTextEntry={true}
                onChangeText={(password) => this.setState({password})}
                value={this.state.password}/>
            
            <TouchableOpacity
                style={styles.btn}
                onPress={() => {
                  this.loading = true; 
                  this.props.login(JSON.stringify(this.state));
                }}>
                <Text style={styles.btnText}>Log in</Text>
            </TouchableOpacity>
             </View></View>
            }
          </View>
        );
      }
}


export default connect()(LoginService);
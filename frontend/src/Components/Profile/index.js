import React, { Component } from 'react';
import { StyleSheet, Text, View, ActivityIndicator, TextInput, ScrollView, TouchableOpacity } from 'react-native';
import { connect }from 'react-redux';

import styles from './styles';
import moment from 'moment';
import 'moment/locale/nl-be';
import GenerateIcon from '../Icon/index';
import Colors from '../../Config/theme';
import Icon from 'react-native-vector-icons/FontAwesome';
class ProfileService extends Component {
  constructor(props) {
        super(props);
        moment.locale('nl-be');
        this.state = {
          data: {},
          edit: {parents: false, address: false, children: false}
        }
  }
  
  componentDidMount() {
      this.props.fetchProfile(this.props.token);
  }   

  componentWillReceiveProps(nextProps) {
        if (nextProps.error == undefined) {
            this.setState({data: nextProps.data});
            console.log('DATA: ', this.state.data)
        }   
    }

    renderAllergies = (title, allegies) => {
      return (
        <View style={[styles.description]}>
        <Text style={styles.section}>{title}</Text>
          {allegies.map((a, o) => {
             return ( 
              <View key={o} style={[styles.column, styles.padded]}>
                <Text style={[styles.info, styles.bold]}>{a.type} {a.gravity}</Text> 
                <Text style={[styles.info]}>{a.description}</Text> 
              </View> )
          })}
        </View>
        )
    }

    changeToEdit = (item) => {
      let currentState = this.state.edit[item];
      this.setState({ edit: { ...this.state.edit, [item]: !currentState}}); 
    }

    renderCare = (title, care) => {
      return (
        <View style={styles.description}>
        <Text style={styles.section}>{title}</Text>
        {care.map((a, o) => {
             return ( 
              <View key={o} style={styles.column}>
                <Text style={[styles.info]}>{a.description}</Text> 
              </View> )
        })}
        </View>
      )
    }
    render() {
        return (
          <ScrollView style={styles.container} keyboardShouldPersistTaps='always' >
           <View style={styles.item}>
             <GenerateIcon name={'users'} size={15} />
              <View style={[styles.label, styles.row, styles.justifiedS ]}>
                <Text style={[styles.bold]}>Familie {this.state.data.family_type}</Text> 
                <TouchableOpacity
                  onPress={() => { this.changeToEdit('parents'); }}>
                  <Icon name={this.state.edit.parents == false? 'pencil': 'times'} size={15}/>
                </TouchableOpacity>
              </View>

              {this.state.data.parents != undefined && this.state.edit['parents'] == false? this.state.data.parents.map((parent, i) => {
                return (
                  <View style={styles.description} key={i}>
                    <Text>{parent.relation}: {parent.name}</Text>
                    <Text>{parent.email}</Text>
                    <Text>{parent.tel}</Text>
                  </View>
              )
              }): null}

              {this.state.data.parents != undefined && this.state.edit['parents'] == true? this.state.data.parents.map((parent, i) => {
                return (
                  <View style={styles.description} key={i}>
                    <Text style={styles.bold}>Naam</Text>
                    <TextInput
                        style={styles.textInput}
                        onChangeText={(name) => {
                          this.state.data.parents[i].name = name;
                          this.setState({
                            data: this.state.data
                          });
                        }}
                        value={parent.name}/>

                    <Text style={styles.bold}>Relatie</Text>
                    <TextInput
                        style={styles.textInput}
                        onChangeText={
                          (relation) => {
                            this.state.data.parents[i].relation = relation;
                            this.setState({
                              data: this.state.data
                            });
                        }}
                        value={parent.relation} />
                    <Text style={styles.bold}>Telefoon</Text>
                    <TextInput
                        style={styles.textInput}
                        onChangeText={(tel) => {
                          this.state.data.parents[i].tel = tel;
                          this.setState({
                            data: this.state.data
                          });
                        }}
                        value={parent.tel} />
                    <Text style={styles.bold}>Email</Text>
                    <TextInput
                        style={styles.textInput}
                        onChangeText={(email) => {
                          this.state.data.parents[i].email = email;
                          this.setState({
                            data: this.state.data
                          });
                        }}
                        value={parent.email} />
                  </View>
              )
              }): null}

            </View>
            { this.state.edit['parents'] == true? <TouchableOpacity style={styles.btnSave}><Text style={styles.btnText}>SAVE</Text></TouchableOpacity>: null}
  
            <View style={styles.item}>
              <GenerateIcon name={'globe'} size={15} />
              <View style={[styles.label, styles.row, styles.justifiedS ]}>
                <Text style={[styles.bold]}>Adres</Text> 
                <TouchableOpacity
                  onPress={() => { this.changeToEdit('address'); }}>
                  <Icon name={this.state.edit.address == false? 'pencil': 'times'} size={15}/>
                </TouchableOpacity>
              </View>
              {this.state.data.address != undefined && this.state.edit.address == false?
              <View style={styles.description}>
                <Text> { this.state.data.address.street +' '+ this.state.data.address.number  + ", " + this.state.data.address.postal_code + ' ' + this.state.data.address.city + ' - ' + this.state.data.address.country}   </Text>
              </View>: null}
              {this.state.edit.address == true?
                  <View style={styles.description}>
                    <Text style={styles.bold}>Straat</Text>
                    <TextInput
                      style={styles.textInput}
                      onChangeText={(street) => {
                        this.state.data.address.street = street;
                        this.setState({
                          data: this.state.data
                        });
                      }}
                      value={this.state.data.address.street}/>

                    <Text style={styles.bold}>Number</Text>
                    <TextInput
                      style={styles.textInput}
                      onChangeText={(number) => {
                        this.state.data.address.number = number;
                        this.setState({
                          data: this.state.data
                        });
                      }}
                      value={this.state.data.address.number}/>

                    <Text style={styles.bold}>Postcode</Text>
                    <TextInput
                      style={styles.textInput}
                      onChangeText={(postal_code) => {
                        this.state.data.address.postal_code = postal_code;
                        this.setState({
                          data: this.state.data
                        });
                      }}
                      value={this.state.data.address.postal_code}/>

                    <Text style={styles.bold}>Gemeente</Text>
                    <TextInput
                      style={styles.textInput}
                      onChangeText={(city) => {
                        this.state.data.address.city = city;
                        this.setState({
                          data: this.state.data
                        });
                      }}
                      value={this.state.data.address.city}/>
                  </View>
              :null}
            </View>
            { this.state.edit['address'] == true? <TouchableOpacity style={styles.btnSave}><Text style={styles.btnText}>SAVE</Text></TouchableOpacity>: null}
            <View style={styles.item}>
             <GenerateIcon name={'child'} size={15} />
              {this.state.data.children!= undefined? this.state.data.children.map((child, i) => {
                return (
                  <View key={i}>
                  <View style={[styles.label, styles.child]}><Text>{child.name}</Text></View>
                    {child.allergies != undefined? this.renderAllergies("Allergieën", child.allergies) : null} 
                    {child.medical != undefined? this.renderCare('Medische aandacht', child.medical) : null }
                    {child.pedagogic != undefined? this.renderCare('Pedagogische aandacht', child.pedagogic) : null}
                  </View>
              )
              }): null}
           </View>
          </ScrollView>
        );
    }
}

export default connect()(ProfileService);
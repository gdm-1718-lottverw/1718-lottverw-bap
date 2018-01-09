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
      const types = [{name: 'Voedsel', value: 'food'}, {name: 'Dieren', value: 'animals'}, {name: 'Insecten', value: 'insects'}, {name: 'Andere', value: 'other'}];
      const gravity = [{name: 'Mild', value: 'light'}, {name: 'Medium', value: 'medium'}, {name: 'Ernstig', value: 'severe'}, {name: 'Dodelijk', value: 'deadly'}];
      
        return (
          <ScrollView style={styles.container} keyboardShouldPersistTaps='always'>
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
            { this.state.edit['parents'] == true? <TouchableOpacity style={styles.btnSave} onPress={() => {
              var result = { 'parent': true, 'parents': this.state.data.parents};
              this.props.UpdateProfile(this.props.token, result);
              this.state.edit['parents'] = false;
              this.setState({ edit: this.state.edit});

            }}><Text style={styles.btnText}>SAVE</Text></TouchableOpacity>: null}
  
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
                <Text> { this.state.data.address.street +' '+ this.state.data.address.number +", "+ this.state.data.address.postal_code + ' ' + this.state.data.address.city + ' - ' + this.state.data.address.country}   </Text>
              </View>: null}
              {this.state.edit.address == true?
                  <View style={styles.description}>
                   <View style={styles.row}>
                    <Text style={[styles.bold, styles.stretch]}>Straat</Text>
                    <Text style={[styles.bold, styles.stretch]}>Number</Text>
                  </View>
                    <View style={styles.row}>
                    <TextInput
                      style={[styles.textInput, styles.stretch]}
                      onChangeText={(street) => {
                        this.state.data.address.street = street;
                        this.setState({
                          data: this.state.data
                        });
                      }}
                      value={this.state.data.address.street}/>

                    
                    <TextInput
                      style={[styles.textInput, styles.stretch]}
                      onChangeText={(number) => {
                        this.state.data.address.number = number;
                        this.setState({
                          data: this.state.data
                        });
                      }}
                      value={this.state.data.address.number}/>
                  </View>
                  <View style={styles.row}>
                    <Text style={[styles.bold, styles.stretch]}>Postcode</Text>
                    <Text style={[styles.bold, styles.stretch]}>Gemeente</Text>
                  </View>
                    <View style={styles.row}>
                    <TextInput
                       style={[styles.textInput, styles.stretch]}
                      onChangeText={(postal_code) => {
                        this.state.data.address.postal_code = postal_code;
                        this.setState({
                          data: this.state.data
                        });
                      }}
                      value={this.state.data.address.postal_code}/>
                    <TextInput
                       style={[styles.textInput, styles.stretch]}
                      onChangeText={(city) => {
                        this.state.data.address.city = city;
                        this.setState({
                          data: this.state.data
                        });
                      }}
                      value={this.state.data.address.city}/>
                  </View>
                    <Text style={styles.bold}>Country</Text>
                    <TextInput
                      style={styles.textInput}
                      onChangeText={(country) => {
                        this.state.data.address.country = country;
                        this.setState({
                          data: this.state.data
                        });
                      }}
                      value={this.state.data.address.country}/>
                  </View>
              :null}
            </View>

            { this.state.edit['address'] == true? <TouchableOpacity style={styles.btnSave} onPress={() => {
              this.state.data.address.address_id = this.state.data.address.id;
              this.state.data.address['address'] = true;
              this.props.UpdateProfile(this.props.token, this.state.data.address);
              this.state.edit['address'] = false;
              this.setState({ edit: this.state.edit});
            }}><Text style={styles.btnText}>SAVE</Text></TouchableOpacity>: null}
            
         
            <View style={styles.item}>
             <GenerateIcon name={'child'} size={15} />
               <View style={[styles.label, styles.row, styles.justifiedS, styles.single]}>
                <Text style={[styles.bold]}>Kind(eren)</Text> 
                <TouchableOpacity
                  onPress={() => { this.changeToEdit('children'); }}>
                  <Icon name={this.state.edit.children == false? 'pencil': 'times'} size={15}/>
                </TouchableOpacity>
            </View>

            
              {this.state.data.children != undefined && this.state.edit['children'] == false? this.state.data.children.map((child, i) => {
                return (
                  <View key={i}>
                  <View style={[styles.label, styles.child]}><Text>{child.name}</Text></View>
                    {child.allergies != undefined? this.renderAllergies("Allergieën", child.allergies) : null} 
                    {child.medical != undefined? this.renderCare('Medische aandacht', child.medical) : null }
                    {child.pedagogic != undefined? this.renderCare('Pedagogische aandacht', child.pedagogic) : null}
                    {child.comments != undefined? this.renderCare('Andere opmerkingen', child.comments) : null}
                  </View>
              )
              }): null}

              {this.state.edit['children'] == true? 
                 this.state.data.children.map((c, i) => {
                  console.log('C', c);
                  return (
                    <View key={i}>
                      <Text style={[styles.label, styles.child]}>{c.name}</Text>
                      <View style={[styles.description]}>

                        <Text style={styles.bold}>Zindelijkheid</Text>
                        <TouchableOpacity onPress={() => {
                        c.potty_trained = !c.potty_trained;
                        this.setState({data: this.state.data});
                      }}>{c.potty_trained == false? 
                        <View style={styles.row}>
                          <View style={styles.radio}></View>
                          <Text>Kind is nog niet zindelijk</Text>
                        </View>
                        : <View style={styles.row}>
                            <View style={[styles.radio, styles.radioFull]}></View>
                            <Text>kind is zindelijk</Text>
                          </View>
                      }</TouchableOpacity>
                      
                        <Text style={styles.bold}>{"Foto's"}</Text>
                        <TouchableOpacity onPress={() => {
                        c.pictures = !c.pictures;
                        this.setState({data: this.state.data});
                      }}>{c.pictures == false? 
                        <View style={styles.row}>
                          <View style={styles.radio}></View>
                          <Text>Er mogen geen {"foto's"} genomen worden</Text>
                        </View>
                        : <View style={styles.row}>
                            <View style={[styles.radio, styles.radioFull]}></View>
                            <Text>Er mogen {"foto's"} genomen worden</Text>
                          </View>
                      }</TouchableOpacity>
                      <Text style={styles.bold}>Arts</Text>
                      <View style={styles.row}>
                      <TextInput
                        style={[styles.textInput, styles.stretch]}
                        onChangeText={(name) => {
                          c.doctor.name = name;
                          this.setState({
                            data: this.state.data
                          });
                        }}
                        value={c.doctor.name}/>
                      <TextInput
                        style={[styles.textInput, styles.stretch]}
                        onChangeText={(tel) => {
                          c.doctor.tel = tel;
                          this.setState({
                            data: this.state.data
                          });
                        }}
                        value={c.doctor.tel}/>
                      </View>

                      <Text style={styles.bold}>Allergiën</Text>

                      {c.allergies != undefined? c.allergies.map((a, o) => {
                        if(a['delete'] == undefined){
                        return (
                          <View>
                            <Text style={[styles.bold]}>Type</Text>
                            <View style={styles.row}>

                            {  types.map((t, i) => {
                            return (
                              <TouchableOpacity style={[styles.row, styles.stretch]} key={i} onPress={() => {
                                a.type = t.value;
                                this.setState({data: this.state.data});
                              }}>{t.value == a.type?  <View style={[styles.radio, styles.radioFull]}></View> : <View style={[styles.radio]}></View>}<Text>{t.name}</Text></TouchableOpacity>
                              )
                            })}
                            </View>
                            <Text style={[styles.bold]}>Ernst</Text>
                              <View  style={styles.row}>
                            {  gravity.map((g, i) => {
                            return (
                              <TouchableOpacity style={[styles.row, styles.stretch]} key={i} onPress={() => {
                                a.gravity = g.value;
                                this.setState({data: this.state.data});
                              }}>{g.value == a.gravity?  <View style={[styles.radio, styles.radioFull]}></View> : <View style={[styles.radio]}></View>}<Text>{g.name}</Text></TouchableOpacity>
                              )
                            })}
                          </View>
                          <Text style={[styles.bold]}>Omschrijving</Text>
                          <TextInput
                              style={[styles.textInput]}
                              multiline={true}
                              onChangeText={(description) => {
                                a.description = description;
                                this.setState({
                                  data: this.state.data
                                });
                              }}
                            value={a.description}/>
                             <TouchableOpacity onPress={() => {
                            a['delete'] = true;
                            this.setState({data: this.state.data});
                          }}><Text>delete</Text></TouchableOpacity>
                        </View>)
                        }
                       }) :null}
                      <TouchableOpacity onPress={() => {
                        c.allergies == undefined? c['allergies'] = [{description: ""}] : c.allergies.push({description: ''});
                        this.setState({data: this.state.data});
                      }}><Text>+allergie</Text></TouchableOpacity>
   
                      <Text style={styles.bold}>Medische aandacht</Text>
                      {c.medical != undefined? c.medical.map((m, o) => {
                        if(m['delete'] == undefined){
                          return (  
                        <View style={[styles.row]}>
                        <TextInput
                          style={[styles.textInput]}
                           multiline={true}
                           onChangeText={(description) => {
                            m.description = description;
                            this.setState({
                              data: this.state.data
                            });
                          }}
                          value={m.description}/>

                          <TouchableOpacity onPress={() => {
                            m['delete'] = true;
                            this.setState({data: this.state.data});
                          }}><Text>delete</Text></TouchableOpacity>
                          </View>
                       )
                        }
                       }) :null}
                       <TouchableOpacity onPress={() => {
                        c.medical == undefined? c['medical'] = [{description: ""}] : c.medical.push({description: ''});
                        this.setState({data: this.state.data});
                      }}><Text>+ medische aandoening</Text></TouchableOpacity>



                      <Text style={styles.bold}>Pedagogische aandacht</Text>   
                      {c.pedagogic != undefined? c.pedagogic.map((p, o) => {
                        if(p['delete'] != true){
                          return ( 
                          <View>
                            <TextInput
                              style={[styles.textInput]}
                              multiline={true}
                              onChangeText={(description) => {
                                p.description = description;
                                this.setState({
                                  data: this.state.data
                                });
                              }}
                              value={p.description}/>
                               <TouchableOpacity onPress={() => {
                            p['delete'] = true;
                            this.setState({data: this.state.data});
                          }}><Text>delete</Text></TouchableOpacity>
                          </View>
                       )
                        }
                        
                       }) :null}
                      <TouchableOpacity onPress={() => {
                        c.pedagogic == undefined? c['pedagogic'] = [{description: ""}] : c.pedagogic.push({description: ''});
                        this.setState({data: this.state.data});
                      }}><Text>+ pedagogische aandoening</Text></TouchableOpacity>
                    </View>  
                  </View>
                  )
                 })



              : null}
              {this.state.edit['children'] == true? <TouchableOpacity style={styles.btnSave} onPress={() => {
              var result = { 'child': true, 'children': this.state.data.children};
              this.props.UpdateProfile(this.props.token, result);
              this.state.edit['children'] = false;
              this.setState({ edit: this.state.edit});

            }}><Text style={styles.btnText}>SAVE</Text></TouchableOpacity>: null}
  
           </View>
          </ScrollView>
        );
    }
}

export default connect()(ProfileService);
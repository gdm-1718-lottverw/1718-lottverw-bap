import React, { Component } from 'react';
import { StyleSheet, Text, View, ListView, ActivityIndicator, TextInput, TouchableOpacity } from 'react-native';
import moment from 'moment';
import 'moment/locale/nl-be';
import {connect }from 'react-redux';
import styles from './styles'
import Icon  from 'react-native-vector-icons/FontAwesome';
import BottomRight from '../../Button/bottomRight';


class ChildCard extends Component {
  constructor(props) {
    super(props);
    moment.locale('nl-be');

    this.state = {
      dataSource: new ListView.DataSource({
        rowHasChanged: (row1, row2) => row1 !== row2,
        sectionHeaderHasChanged : (s1, s2) => s1 !== s2,
      })
    };
  }
    componentDidMount() {
      this.props.callService(); //call our action
    }   
componentWillReceiveProps(nextProps) {
      if (nextProps.data.length > 0 && nextProps.error == undefined) {
        const getSectionData = (dataBlob, sectionId) => dataBlob[sectionId];
        const getRowData = (dataBlob, sectionId, rowId) => dataBlob[`${rowId}`];
        const ds = new ListView.DataSource({
          rowHasChanged: (r1, r2) => r1 !== r2,
          sectionHeaderHasChanged : (s1, s2) => s1 !== s2,
          getSectionData,
          getRowData,
        });
        
        const { dataBlob, sectionIds, rowIds } = this.formatData(nextProps.data);
        this.setState({
          dataSource: ds.cloneWithRowsAndSections(dataBlob, sectionIds, rowIds),
        });
      } 
    }
     
      SectionHeader = (props) => (
        <View style={styles.header}>
          <Text style={styles.lightText}>{props.character}</Text>
        </View>
      );

      renderCell = (rowData) => (
        <View style={styles.row}>
            <Text style={styles.date}>{moment(rowData.date).format('ddd DD.MM.YYYY')}</Text>
            <View style={styles.content}>
              <View style={styles.TypeContainer}>
                <Text style={styles.type}>{rowData.type.toUpperCase()}</Text>
                <Text style={styles.text}>{rowData.name}</Text>
              </View>
              <View style={styles.actions}>
                <Icon style={styles.edit} name="pencil"  size={20}/>
                <Icon style={styles.trash} name="trash"  size={20}/>
              </View>
            </View>
        </View>
    );
      render() {
        return (
          <View  style={styles.container}>
          <ListView
            enableEmptySections={true}
            dataSource={this.state.dataSource}
            renderRow={(data) => this.renderCell(data)}
            renderSectionHeader={(sectionData) => this.SectionHeader(sectionData)}
          />
          <BottomRight name={'plus'}/>
          </View>
        );
      }

      formatData(data) {
        // We're sorting by alphabetically so we need the alphabet
        //const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
        const months = moment.months();
        console.log("LOG 85: months", months);
        // Need somewhere to store our data
        const dataBlob = {};
        const sectionIds = [];
        const rowIds = [];
    
        // Each section is going to represent a letter in the alphabet so we loop over the alphabet
        for (let sectionId = 0; sectionId < months.length; sectionId++) {
          // Get the character we're currently looking for
          const currentChar = months[sectionId];
          // Get users whose first name starts with the current letter
          const cards = data.filter((card) => moment(card.date).format('MMMM') === currentChar);
    
          // If there are any users who have a first name starting with the current letter then we'll
          // add a new section otherwise we just skip over it
          if (cards.length > 0) {
            // Add a section id to our array so the listview knows that we've got a new section
            sectionIds.push(sectionId);
            // Store any data we would want to display in the section header. In our case we want to show
            // the current character
            dataBlob[sectionId] = { character: currentChar };
    
            // Setup a new array that we can store the row ids for this section
            rowIds.push([]);
    
            // Loop over the valid users for this section
            for (let i = 0; i < cards.length; i++) {
              // Create a unique row id for the data blob that the listview can use for reference
              const rowId = `${sectionId}:${i}`;
    
              // Push the row id to the row ids array. This is what listview will reference to pull
              // data from our data blob
              rowIds[rowIds.length - 1].push(rowId);
    
              // Store the data we care about for this row
              dataBlob[rowId] = cards[i];
            }
          }
        }
        console.log(dataBlob, sectionIds, rowIds );
        return { dataBlob, sectionIds, rowIds };
      }
}


export default connect()(ChildCard);
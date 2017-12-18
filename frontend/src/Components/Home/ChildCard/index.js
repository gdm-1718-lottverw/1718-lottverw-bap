import React, { Component } from 'react';
import { StyleSheet, Text, View, ListView, ActivityIndicator, TextInput, TouchableOpacity } from 'react-native';
import moment from 'moment';
import 'moment/locale/nl-be';
import {connect }from 'react-redux';
import styles from './styles'
import { Actions } from 'react-native-router-flux';
import Icon  from 'react-native-vector-icons/FontAwesome';
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
      this.props.callService(); 
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
              <View style={styles.actions}>
                <Icon style={styles.edit} name="pencil"  size={20}/>
                <Icon style={styles.trash} name="trash"  size={20}/>
               </View>
              <View style={styles.TypeContainer}>
                <Text style={styles.type}>{rowData.type.toUpperCase()}</Text>
                <Text style={styles.text}>{rowData.name}</Text>
              </View>
             
            </View>
        </View>
    );
      render() {
        return (
          <View  style={styles.container}>
          <ListView
            style={styles.list}
            enableEmptySections={true}
            dataSource={this.state.dataSource}
            renderRow={(data) => this.renderCell(data)}
            renderSectionHeader={(sectionData) => this.SectionHeader(sectionData)}
          />
          </View>
        );
      }

      formatData(data) {
        const months = moment.months();
        const dataBlob = {};
        const sectionIds = [];
        const rowIds = [];
    
        for (let sectionId = 0; sectionId < months.length; sectionId++) {
          const currentChar = months[sectionId];
          const cards = data.filter((card) => moment(card.date).format('MMMM') === currentChar);

          if (cards.length > 0) {
            sectionIds.push(sectionId);
            dataBlob[sectionId] = { character: currentChar };
            rowIds.push([]);
  
            for (let i = 0; i < cards.length; i++) {
              const rowId = `${sectionId}:${i}`;
              rowIds[rowIds.length - 1].push(rowId);
              dataBlob[rowId] = cards[i];
            }
          }
        }
        return { dataBlob, sectionIds, rowIds };
      }
}


export default connect()(ChildCard);
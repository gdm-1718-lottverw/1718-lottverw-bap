import { StyleSheet } from 'react-native';
import Colors from '../../../Config/theme';

export default styles = StyleSheet.create({
    container: {
        flex: 1,
    },
    header: {
        backgroundColor: Colors.deeppink,
        height: 40,
        padding: 8,
        paddingLeft: 25,
     //   fontWeight: '100'
    },
    lightText: {
      color: Colors.white,
      fontSize: 17,
    },
    list: {
        
    },
    row: {
        flex: 1,
        padding: 25,
        paddingTop: 20,
        paddingBottom: 20,
        flexDirection: 'column',
        backgroundColor: Colors.gray,
        marginBottom: 2,
    },
    date: {
      fontSize: 16,
      textAlign: 'right',
      borderBottomWidth: 1,
      marginBottom: 3
    },
    TypeContainer: {
      flex: 1,
      flexDirection: 'column',
      padding: 5,
    },
    text: {
        fontSize: 16,
      //  fontWeight: '200'
    },
    type: {
     // fontWeight: '700'
    },
    actions:{
        paddingTop: 5,
        paddingRight: 10,
        marginRight: 10,
    },
    content: {
        flex: 1,
        flexDirection: 'row',
    },
    edit: {
        marginBottom: 3,
        backgroundColor: Colors.lightBlue,
        height: 50,
        width: 50,
        color: Colors.white,
        paddingTop: 13,
        fontSize: 22,
        paddingLeft: 16,
    },
    trash: {
        backgroundColor: Colors.pink,
        height: 50,
        width: 50,
        color: Colors.white,
        paddingTop: 13,
        fontSize: 22,
        paddingLeft: 16,
    }
});
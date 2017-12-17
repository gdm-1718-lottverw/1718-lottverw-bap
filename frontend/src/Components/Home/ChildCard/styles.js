import { StyleSheet } from 'react-native';
import Colors from '../../../Config/theme';

export default styles = StyleSheet.create({
    container: {
        flex: 1,
        marginBottom: 50,
    },
    header: {
        backgroundColor: Colors.deeppink,
        height: 40,
        padding: 8,
        paddingLeft: 25,
        fontWeight: '100'
    },
    lightText: {
      color: Colors.white,
      fontSize: 17,
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
    },
    content: {
        flex: 1,
        flexDirection: 'row',
      },
    text: {
        fontSize: 16,
        fontWeight: '200'
    },
    type: {
      marginTop: 7,
      fontWeight: '700'
    },
    edit: {
        margin: 7,
        borderRadius: 50,
        backgroundColor: Colors.lightBlue,
        height: 35,
        width: 35,
        color: Colors.white,
        paddingTop: 7,
        paddingLeft: 9,
    },
    trash: {
        margin: 5,
        marginRight: 7,
        borderRadius: 50,
        backgroundColor: Colors.pink,
        height: 36,
        width: 36,
        color: Colors.white,
        paddingTop: 8,
        paddingLeft: 10,
    }
});
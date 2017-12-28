import { StyleSheet } from 'react-native';
import Colors from '../../Config/theme';

export default styles = StyleSheet.create({
    container: {
      margin: 20,
    },
    label: {
        fontWeight: '800',
        color: Colors.darkgrey,
        marginBottom:0
    },
    textInput: {
        marginBottom: 15,
    },
    btn: {
        backgroundColor: Colors.green,
        alignContent: 'flex-end',
        padding: 15,
        alignItems: 'center',
    }, 
    btnText: {
        color: '#FFF'
    }, 
    picker: {
        backgroundColor: Colors.green,
        margin: 5,
    }

});
import { StyleSheet } from 'react-native';
import Colors from '../../Config/theme';

export default styles = StyleSheet.create({
    container: {
      backgroundColor: Colors.white,
      padding: 20,
      paddingTop: 15
    },
    label: {
        fontWeight: '800',
        color: Colors.darkgrey,
        marginBottom: 5,
        padding: 3,
        paddingLeft: 0,
        paddingRight: 0,
    },
    textInput: {
        marginBottom: 15,
        borderWidth: 1, 
        borderColor: Colors.darkgrey
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
    },
    btnBack: {
        borderRadius: 50,
        width: 30, 
        height: 30, 
        alignSelf: 'flex-end',
        paddingLeft: 7,
    }, 
    btnIcon: {
        color: Colors.darkgrey,
    }, 
    checkbox: {
        backgroundColor: Colors.yellow,

    }

});
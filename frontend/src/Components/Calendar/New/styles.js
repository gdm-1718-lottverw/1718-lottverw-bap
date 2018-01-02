import { StyleSheet } from 'react-native';
import Colors from '../../../Config/theme';

export default styles = StyleSheet.create({
    iconTest: {
        color: Colors.lightBlue,
        backgroundColor: Colors.white,
        paddingLeft: 8,
        paddingTop: 8,
        borderRadius: 20,
        height: 30,
        width: 30,
        zIndex: 3
    }, 
    icon:{
        color: Colors.darkgray,
        marginLeft: 10,
        paddingTop: 20,

    },
    description: {
        backgroundColor: Colors.white,
        padding: 5,
        marginBottom: 5,
        marginLeft: 35,
        borderBottomRightRadius: 7,
        borderBottomLeftRadius: 7,
        marginRight: 10,

    },
    label: {
        fontWeight: '900',
        backgroundColor: Colors.white,
        marginLeft: 35,
        marginRight: 10,
        marginTop: -18,
        marginBottom: 4,
        paddingTop: 7,
        paddingLeft: 12,
        paddingBottom: 7,
        borderTopRightRadius: 7,
        borderTopLeftRadius: 7
    },
    single: {
        borderRadius: 7
    },
    active: {
        backgroundColor: Colors.pink
    },
    check: {
        paddingLeft: 10,
        padding: 2,
        marginBottom: 1,
        display: 'flex',
        flexDirection: 'row'
    },
    checkText: {
        
    },
    checkIcon: {
        padding: 4,
        marginRight: 3,
    },
    textInput: {
        marginLeft: 5,
        marginRight: 5
    },
    btn: {
        backgroundColor: Colors.lightBlue,
        alignContent: 'flex-end',
        padding: 15,
        alignItems: 'center',
        borderRadius: 7,
        margin: -20,
        marginTop: 12,
        marginBottom: 0,

    }, 
    btnText: {
        color: Colors.white,
    },

});
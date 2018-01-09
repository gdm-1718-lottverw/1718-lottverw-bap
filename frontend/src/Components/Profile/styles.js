import { StyleSheet } from 'react-native';
import Colors from '../../Config/theme';

const styles = StyleSheet.create({
      description: {
        backgroundColor: Colors.white,
        padding: 12,
        marginBottom: 5,
        marginLeft: 35,
        borderBottomRightRadius: 7,
        borderBottomLeftRadius: 7,
        marginRight: 10,
        paddingLeft: 12,
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
        paddingRight: 12,
        paddingBottom: 7,
        borderTopRightRadius: 7,
        borderTopLeftRadius: 7
    },
    single: {
		borderRadius: 7
	},
    padded: {
        marginTop: 10
    },
    justifiedS: {
        justifyContent:'space-between' 
    },
	row: {
		display: 'flex',
        flexDirection: 'row',
        marginVertical: 3,
	},
    stretch: {
        flex: 1,
    },
    column: {
        display: 'flex',
        flexDirection: 'column',
    },
    info: {
        fontSize: 11,
    },
	bold: {
		fontWeight: '900',
        padding: 0,
        margin: 0,
	},
	section: {
		fontSize: 10,
        fontWeight: '700',
		paddingBottom: 2
	}, 
    child: {
        marginTop: 2,
    },
    btnSave: {
        backgroundColor: Colors.green,
        borderRadius: 7,
        padding: 10, 
        marginHorizontal: 10,
        marginLeft: 35,
    }, 
    btnText: {
         textAlign: 'center'
    },
    radio: {
        marginVertical: 5,
        marginRight: 5,
        height: 10, 
        width: 10, 
        borderWidth: 1,
        borderRadius: 100,
        borderColor: Colors.darkgray
    },
    radioFull: {
        backgroundColor: Colors.darkgrey
    },
    textInput: {
        margin: 0,
        padding: 0,
        paddingBottom: 7,
        paddingLeft: 3
    },
});
export default styles;
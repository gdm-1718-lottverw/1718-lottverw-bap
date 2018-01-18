import { StyleSheet } from 'react-native';
import Colors from '../../../Config/theme';

const styles = StyleSheet.create({
    container: {
        alignSelf: "stretch",
        justifyContent: 'flex-start',
        margin: 10,
    },
    label: {
        fontWeight: '800',
        color: Colors.darkgrey,
        marginBottom: 0, 
    },
    textInput: {
        marginBottom: 15,
        paddingHorizontal: 5,
        paddingVertical: 7,
        borderBottomColor: Colors.darkgrey
    },
    btn: {
        backgroundColor: Colors.darkgrey,
        padding: 15,
        alignItems: 'center',
    }, 
    btnText: {
        color: '#FFF'
    }, 
    error: {
        color: '#efefef',
        textAlign: 'center',
        fontWeight: '800',
        marginTop: 10,
        marginBottom: 10,
        backgroundColor: 'red',
        padding: 5
    }
});
export default styles;
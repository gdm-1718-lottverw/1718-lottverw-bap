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
        marginBottom:0
    },
    textInput: {
        marginBottom: 15,
    },
    btn: {
        backgroundColor: Colors.darkgrey,
        padding: 15,
        alignItems: 'center',
    }, 
    btnText: {
        color: '#FFF'
    }
});
export default styles;
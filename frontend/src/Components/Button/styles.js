import { StyleSheet } from 'react-native';
import Colors from '../../Config/theme';

const styles = StyleSheet.create({
    container: {
        backgroundColor: Colors.yellow,
        height: 55,
        width: 55,
        borderRadius: 50,
        position: 'absolute',
        bottom: 10,
        right: 10
    },
    icon: {
        fontSize: 27,
        paddingTop: 15,
        paddingLeft: 17,
        color: Colors.darkgrey
    }
});
export default styles;
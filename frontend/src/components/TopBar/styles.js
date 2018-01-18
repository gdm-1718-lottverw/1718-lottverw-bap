import { StyleSheet } from 'react-native';
import Colors from '../../Config/theme';

const styles = StyleSheet.create({
    container: {
        flex: 1,
        flexDirection: 'row',
        justifyContent: 'space-between',
        marginTop: 24,
        backgroundColor: Colors.darkgrey,
        paddingVertical: 8,
        paddingHorizontal: 20,
        height: 35,
        maxHeight: 35,
        minHeight: 35,
    },
    text: {
        color: Colors.white,
        fontSize: 13,
    },
    icon: {
        color: Colors.white,
        fontSize: 13,
        marginTop: 3,
    },
});
export default styles;
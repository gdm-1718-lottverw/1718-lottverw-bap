import { StyleSheet } from 'react-native';
import Colors from '../../config/theme';

const styles = StyleSheet.create({
    container: {
        alignSelf: "stretch",
        justifyContent: 'flex-start',
        flex: 1,
        maxHeight: 47,
    },
    element: {
        backgroundColor: Colors.darkBlue,
        textAlign: 'center',
        height: 47,
        padding: 13,
        color: Colors.white,
        fontWeight: '700',
        fontFamily: "Roboto"
    },
});
export default styles;
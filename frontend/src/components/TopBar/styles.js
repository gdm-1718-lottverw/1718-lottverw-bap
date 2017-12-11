import { StyleSheet } from 'react-native';
import Colors from '../../Config/theme';

const styles = StyleSheet.create({
    container: {
        alignSelf: "stretch",
        justifyContent: 'flex-start',
        flexDirection: 'row',
        flex: 1,
        backgroundColor: Colors.darkBlue,
        maxHeight: 35,
    },
    text: {
        textAlign: 'left',
        padding: 9,
        paddingLeft: 20,
        fontSize: 14,
        color: Colors.white,
        fontWeight: '700',
        fontFamily: "Roboto",
        alignSelf: "stretch",
        justifyContent: 'flex-start',
        flex: 5,
    },
    icon: {
        alignSelf: "stretch",
        justifyContent: 'flex-end',
        flex: 1,
        textAlign: 'right',
        paddingTop: 10,
        paddingRight: 20,
        fontSize: 15,
        color: Colors.white,
        width: 50
    },
});
export default styles;
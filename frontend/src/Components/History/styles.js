import { StyleSheet } from 'react-native';
import Colors from '../../Config/theme';

const styles = StyleSheet.create({
    header: {
    	backgroundColor: Colors.darkBlue, 
    	padding: 7,
    }, 
    headerText: {
    	color: Colors.white,
    },
    container: {
    	marginTop: 20
    },
    row: {
    	display: 'flex', 
    	flexDirection: 'row', 
    },
    item: {
    	backgroundColor: Colors.white, 
    	marginVertical: 5, 
    	marginHorizontal: 10, 
    	padding: 7, 
    	borderRadius: 7
    }, 
    bold: {
    	fontWeight: '700', 
    }, 
    mRight: {
    	paddingRight: 10,
    }, 
    alert: {
    	padding: 5,
    	flexDirection: 'column', 
    	alignItems: 'center' 
    },
    mTop: {
    	paddingTop: 10
    },
    description: {
    	fontWeight: '400', 
    	textAlign: 'center', 
    	fontSize: 12,
    	marginHorizontal: 7,
    	marginBottom: 10
    },
    red: {
    	color: Colors.pink
    }, 
    center: {
    	textAlign: 'center'
    }
});
export default styles;
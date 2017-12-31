import { StyleSheet } from 'react-native';
import Colors from '../../Config/theme';

const styles = StyleSheet.create({
    header: {
    	backgroundColor: Colors.darkBlue, 
    	borderRadius: 5, 
    	padding: 7,
    	margin: 5, 
    }, 
    headerText: {
    	color: Colors.white,
    },
    row: {
    	backgroundColor: Colors.white,
    	borderRadius: 5, 
    	padding: 7, 
    	margin: 5, 
    }, 
    noShow: {
    	position: 'relative',

    },
    error: {
    	position: 'absolute',
    	backgroundColor: Colors.darkgray,
    	color: Colors.white, 
    	top: 0,
    }, 
    data: {	
		position: 'absolute',
		top: 0;
    }
});
export default styles;
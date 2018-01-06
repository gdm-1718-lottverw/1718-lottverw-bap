import { StyleSheet } from 'react-native';
import Colors from '../../Config/theme';

const styles = StyleSheet.create({
	item: {
		backgroundColor: Colors.white,
		borderRadius: 5,
    	padding: 10,
    	marginRight: 10,
		marginTop: 8,
		marginBottom: 5,
		flex: 1,
		flexDirection: 'row',
		justifyContent: 'space-between'
	},
	text: {	},
	actions: {
	},
	action: {
		margin: 4,
	}, 
	agenda: {
		zIndex: 3,
	},
	child: {
		fontWeight: '900',
		marginBottom: 3,
		height: 20,
		fontSize: 15
	},
	description: {
		marginBottom: 15,
		marginLeft: 15,
	},
	note: {
		color: '#a2a2a2',
		fontSize: 10,
		paddingLeft: 5,
		paddingRight: 5,
		marginBottom: 8,
		fontStyle: 'italic'
	}
});
export default styles;
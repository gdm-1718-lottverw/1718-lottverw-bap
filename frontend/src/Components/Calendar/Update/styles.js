import { StyleSheet } from 'react-native';
import Colors from '../../../Config/theme';

const styles = StyleSheet.create({
	 loadingContainer: {
        marginTop: 100,
    },
	description: {
		backgroundColor: Colors.white,
		padding: 5,
		marginBottom: 5,
		marginLeft: 35,
		borderBottomRightRadius: 7,
		borderBottomLeftRadius: 7,
		marginRight: 10,
	},
	checked: {
        backgroundColor: '#000000', 
        height: 10, 
        width:10, 
        borderRadius: 7,  
        marginTop: 5, 
        marginRight: 5
    },
    unChecked: {
        backgroundColor: '#FFFFFF', 
        borderColor: '#000', 
        borderWidth: 1, 
        height: 10,
        width:10, 
        borderRadius: 7, 
        marginTop: 5, 
        marginRight: 5
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
		paddingBottom: 7,
		borderTopRightRadius: 7,
		borderTopLeftRadius: 7
	},
	btn: {
		backgroundColor: Colors.lightBlue,
        paddingVertical: 15,
        alignItems: 'center',
		marginTop: 12,
        marginBottom: 0,
        flex: 3,
	}, 
	btnText: {
		color: Colors.white,
	},
	btnDelete: {
		backgroundColor: Colors.pink,
		flex: 1,
		alignItems: 'center',
		marginTop: 12,
		paddingVertical: 15,
	},
	single: {
		borderRadius: 7
	},
	row: {
		display: 'flex',
        flexDirection: 'row',
	},
   
	active: {
		backgroundColor: Colors.pink
	},
	check: {
		paddingLeft: 10,
		padding: 2,
		marginBottom: 1,
		display: 'flex',
		flexDirection: 'row'
	},
	checkText: {
		
	},
	checkIcon: {
		padding: 4,
		marginRight: 3,
	},
	textInput: {
		marginLeft: 5,
		marginRight: 5
	},
	
});
export default styles;
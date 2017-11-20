import { connect } from 'react-redux';
import Profile  from '../screens/Profile';
import {updateProfile, recievedChild} from '../actions/index';

const mapStateToProps = (state) => ({
      name: state.name
});

const mapDispatchToProps = (dispatch) => ({
    onNameUpdate: (value) => {
        dispatch(updateProfile(value))
    },
    onReceivedChild: (child) => {
        dispatch(recievedChild(child));
    }
});


export default connect(
    mapStateToProps,
    mapDispatchToProps
)(Profile)
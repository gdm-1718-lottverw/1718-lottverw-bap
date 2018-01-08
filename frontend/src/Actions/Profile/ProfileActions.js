import * as ActionTypes from '../ActionTypes';
import axios from 'axios';
import ProfileService from '../../Components/Profile/index';

import { connect } from 'react-redux';
import { URL } from '../../Config/index';
import { Actions } from 'react-native-router-flux';

const mapStateToProps = (state) => ({   
    isLoading: state.profile.isLoading,
    error: state.profile.error,
    data: state.profile.data,
    token: state.auth.token,
});

const mapDispatchToProps = (dispatch) => ({
    fetchProfile: (token) => dispatch(fetchProfile(token)),
})

export const profilePending = () => ({
    type: ActionTypes.PROFILE_PENDING
})

export const profileSuccess = (data) => ({
    type: ActionTypes.PROFILE_SUCCESS,
    data: data
})

export const profileError = (error) => ({
    type: ActionTypes.PROFILE_ERROR,
    error: error
})

export const fetchProfile = (token) => {
    return dispatch => {
        dispatch(profilePending())
        axios.get(`${URL}parents/profile`, {headers: {'Authorization': `Bearer ${token}`}})
        .then(response => {
            console.log('RESPONSE', response);
            dispatch(profileSuccess(response.data))
        })
        .catch(error => {
            dispatch(profileError(error))
        });
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ProfileService);

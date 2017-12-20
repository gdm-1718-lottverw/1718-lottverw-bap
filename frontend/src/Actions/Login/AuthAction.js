import * as ActionTypes from '../actionTypes';
import { connect } from 'react-redux';
import axios from 'axios';
import LoginService from '../../Components/Auth/Login/index';

const mapStateToProps = (state) => ({   
    isLoading: state.authReducer.isLoading,
    error: state.authReducer.error,
    credentials: state.authReducer.credentials,
    loggedIn: state.authReducer.loggedIn
});

const mapDispatchToProps = (dispatch) => ({
    login: (credentials) => dispatch(login(credentials))
})

export const login = (credentials) => {
    return dispatch => {
        dispatch(loginPending())
        axios.post(
            'http://192.168.43.16:8000/api/auth', 
            credentials, 
            { headers: {'Content-type': 'application/json'}
        }) 
        .then(response => {
            console.log(response.data);
            dispatch(loginSuccess(response.data))
        })
        .catch(error => {
            dispatch(loginError(error))
        });
    }
}

export const loginPending = () => ({
    type: ActionTypes.SERVICE_PENDING
})

export const loginSuccess = (error) => ({
    type: ActionTypes.SERVICE_SUCCESS,
    error: error
})

export const loginError = (data) => ({
    type: ActionTypes.SERVICE_ERROR,
    data: data
})

export default connect(mapStateToProps, mapDispatchToProps)(LoginService);
import * as ActionTypes from '../actionTypes';
import { connect } from 'react-redux';
import axios from 'axios';
import LoginService from '../../Components/Auth/Login/index';
import token from '../../Config/index';
import { Actions } from 'react-native-router-flux';

const mapStateToProps = (state) => ({   
    isLoading: state.auth.isLoading,
    error: state.auth.error,
    token: state.auth.token
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
        .then(
            response => { 
                dispatch(loginSuccess(response.data)),
                Actions.home()

            })
        .catch(error => {
            dispatch(loginError(error))
        });
    }
}

export const loginPending = () => ({
    type: ActionTypes.LOGGING_IN
})

export const loginSuccess = (data) => ({
    type: ActionTypes.LOGIN_SUCCESS,
    data: data
})

export const loginError = (error) => ({
    type: ActionTypes.LOGIN_ERROR,
    error: error
})

export default connect(mapStateToProps, mapDispatchToProps)(LoginService);
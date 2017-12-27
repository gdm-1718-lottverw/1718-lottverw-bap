import * as ActionTypes from '../ActionTypes';
import axios from 'axios';
import LoginService from '../../Components/Auth/Login/index';
import token from '../../Config/index';
import { Actions } from 'react-native-router-flux';
import { connect } from 'react-redux';
import { URL } from '../../Config/index';

const mapStateToProps = (state) => ({   
    isLoading: state.auth.isLoading,
    error: state.auth.error,
    token: state.auth.token
});

const mapDispatchToProps = (dispatch) => ({
    login: (credentials) => dispatch(login(credentials))
})

export const login = (credentials) => {
    console.log(         
        URL + 'auth', 
        credentials, 
        { headers: {'Content-Type': 'application/json'}}
    );
    return dispatch => {
        console.log(URL + 'auth');
        dispatch(loginPending());
        axios.post(
            URL + 'auth', 
            credentials, 
            { headers: {'Content-Type': 'application/json'}}
        ) 
        .then(
            response => { 
                dispatch(loginSuccess(response.data)),
                Actions.home(),
                console.log('SUCCESS');

            })
        .catch(error => {c
            console.log(error);
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
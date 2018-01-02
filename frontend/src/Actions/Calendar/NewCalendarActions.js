import * as ActionTypes from '../ActionTypes';
import axios from 'axios';
import  NewCalendarSevice from '../../Components/Calendar/New/index';
import { connect } from 'react-redux';
import { URL } from '../../Config/index';
import { Actions } from 'react-native-router-flux';

const mapStateToProps = (state) => ({   
    isLoading: state.children.isLoading,
    error: state.children.error,
    data: state.children.data,
    token: state.auth.token,
    id: state.auth.id
});

const mapDispatchToProps = (dispatch) => ({
    fetchChildren: (token, id) => dispatch(fetchChildren(token, id)),
    submitNewAttendance: (token, id, data) => dispatch(submitNewAttendance(token, id, data))
})


export const childrenPending = () => ({
    type: ActionTypes.CHILDREN_PENDING
})

export const childrenSuccess = (data) => ({
    type: ActionTypes.CHILDREN_SUCCESS,
    data: data
})

export const childrenError = (error) => ({
    type: ActionTypes.CHILDREN_ERROR,
    error: error
})

export const submitPending = () => ({
    type: ActionTypes.SUBMIT_PENDING
})

export const submitSuccess = (data) => ({
    type: ActionTypes.SUBMIT_SUCCESS,
    data: data
})

export const submitError = (error) => ({
    type: ActionTypes.SUBMIT_ERROR,
    error: error
})

export const fetchChildren = (token, id) => {
    return dispatch => {
        dispatch(childrenPending())
        axios.get(`${URL}parents/${id}/calendar/children`, {headers: {'Authorization': `Bearer ${token}`}})
        .then(response => {
            dispatch(childrenSuccess(response.data))
        })
        .catch(error => {
            dispatch(childrenError(error))
        });
    }
}

export const submitNewAttendance = (token, id, data) => {
    return dispatch => {
        dispatch(submitPending())
        axios.post( `${URL}parents/${id}/calendar/create`, data, {headers: {'Content-Type': 'application/json', 'Authorization': `Bearer ${token}`}})
        .then(response => {
            dispatch(submitSuccess(response.data));
            Actions.pop()
        })
        .catch(error => {
            dispatch(submitError(error))
        });
    }
}
export default connect(mapStateToProps, mapDispatchToProps)(NewCalendarSevice);

import * as ActionTypes from '../actionTypes';
import { connect } from 'react-redux';
import axios from 'axios';
import ChildCard from '../../Components/Home/ChildCard/index';

const mapStateToProps = (state) => ({
    isLoading: state.child.isLoading,
    error: state.child.error,
    data: state.child.data
});

const mapDispatchToProps = (dispatch) => ({
    callService: () => dispatch(callWebservice())
})

export const callWebservice = () => {
    return dispatch => {
        dispatch(serviceActionPending())
        axios.get('http://192.168.1.155:8000/api/parents/6/children/planning')
        .then(response => {
            dispatch(serviceActionSuccess(response.data))
        })
        .catch(error => {
            dispatch(serviceActionError(error))
        });
    }
}

export const serviceActionPending = () => ({
    type: ActionTypes.SERVICE_PENDING
})

export const serviceActionError = (error) => ({
    type: ActionTypes.SERVICE_ERROR,
    error: error
})

export const serviceActionSuccess = (data) => ({
    type: ActionTypes.SERVICE_SUCCESS,
    data: data
})

export default connect(mapStateToProps, mapDispatchToProps)(ChildCard);
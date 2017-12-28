import * as ActionTypes from '../ActionTypes';
import axios from 'axios';
import ChildCard from '../../Components/Home/ChildCard/index';
import { AsyncStorage } from 'react-native';
import { connect } from 'react-redux';
import { URL } from '../../Config/index';

const mapStateToProps = (state) => ({
    isLoading: state.child.isLoading,
    error: state.child.error,
    data: state.child.data, 
    token: state.auth.token,
    id: state.auth.id
});

const mapDispatchToProps = (dispatch) => ({
    callService: (token, id) => dispatch(callWebservice(token, id))
})

export const callWebservice = (token, id) => {
    return dispatch => {
        dispatch(serviceActionPending())
        axios.get(`${URL}parents/${id}/children/planning`, {headers: {'Authorization': `Bearer ${token}`}})
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
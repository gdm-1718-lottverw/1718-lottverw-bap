import * as ActionTypes from '../ActionTypes';
import axios from 'axios';
import  QuickAddService from '../../Components/QuickAdd/index';
import { connect } from 'react-redux';
import { URL } from '../../Config/index';

const mapStateToProps = (state) => ({   
    isLoading: state.children.isLoading,
    error: state.children.error,
    data: state.children.data,
    token: state.auth.token,
    id: state.auth.id
});

const mapDispatchToProps = (dispatch) => ({
    fetchChildren: (token, id) => dispatch(fetchChildren(token, id))
})

export const fetchChildren = (token, id) => {
    return dispatch => {
        dispatch(childrenPending())
        axios.get(`${URL}parents/${id}/children`, {headers: {'Authorization': `Bearer ${token}`}})
        .then(response => {
            dispatch(childrenSuccess(response.data))
        })
        .catch(error => {
            dispatch(childrenError(error))
        });
    }
}

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

export default connect(mapStateToProps, mapDispatchToProps)(QuickAddService);

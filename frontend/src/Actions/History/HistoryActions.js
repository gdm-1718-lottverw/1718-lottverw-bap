import * as ActionTypes from '../ActionTypes';
import axios from 'axios';
import HistoryService from '../../Components/History/index';

import { connect } from 'react-redux';
import { URL } from '../../Config/index';
import { Actions } from 'react-native-router-flux';

const mapStateToProps = (state) => ({   
    isLoading: state.history.isLoading,
    error: state.history.error,
    data: state.history.data,
    token: state.auth.token,
    id: state.auth.id
});

const mapDispatchToProps = (dispatch) => ({
    fetchHistory: (token, id) => dispatch(fetchHistory(token, id)),
})

export const historyPending = () => ({
    type: ActionTypes.HISTORY_PENDING
})

export const historySuccess = (data) => ({
    type: ActionTypes.HISTORY_SUCCESS,
    data: data
})

export const historyError = (error) => ({
    type: ActionTypes.HISTORY_ERROR,
    error: error
})

export const fetchHistory = (token, id) => {
    return dispatch => {
        dispatch(historyPending())
        axios.get(`${URL}parents/${id}/history`, {headers: {'Authorization': `Bearer ${token}`}})
        .then(response => {
            dispatch(historySuccess(response.data))
        })
        .catch(error => {
            dispatch(historyError(error))
        });
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(HistoryService);

import * as ActionTypes from '../ActionTypes';
import axios from 'axios';
import  CalendarService from '../../Components/Calendar/index';
import { connect } from 'react-redux';
import { URL } from '../../Config/index';

const mapStateToProps = (state) => ({   
    isLoading: state.calendar.isLoading,
    error: state.calendar.error,
    data: state.calendar.data,
    token: state.auth.token,
    id: state.auth.id,
    deleted: state.calendar.deleted,
    deleting: state.calendar.deleting
});

const mapDispatchToProps = (dispatch) => ({
    fetchDates: (token, id) => dispatch(fetchDates(token, id)),
})

export const calendarPending = () => ({
    type: ActionTypes.CALENDAR_PENDING
})

export const calendarSuccess = (data) => ({
    type: ActionTypes.CALENDAR_SUCCESS,
    data: data
})

export const calendarError = (error) => ({
    type: ActionTypes.CALENDAR_ERROR,
    error: error
})


export const fetchDates = (token, id) => {
    return dispatch => {
        dispatch(calendarPending())
        axios.get(`${URL}parents/${id}/calendar`, {headers: {'Authorization': `Bearer ${token}`}})
        .then(response => {
            dispatch(calendarSuccess(response.data))
            
        })
        .catch(error => {
            dispatch(calendarError(error))
        });
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(CalendarService);



import * as ActionTypes from '../ActionTypes';
import axios from 'axios';
import  UpdateCalendarService from '../../Components/Calendar/Update/index';
import { connect } from 'react-redux';
import { URL } from '../../Config/index';
import { Actions } from 'react-native-router-flux';

const mapStateToProps = (state) => ({   
    isLoading: state.calendar.isLoading,
    error: state.calendar.error,
    item: state.calendar.item,
    children: state.calendar.children,
    guardians: state.calendar.guardians,
    updated: state.calendar.updated,
    updating: state.calendar.updating,
    token: state.auth.token,
    id: state.auth.id,

});

const mapDispatchToProps = (dispatch) => ({
    fetchItem: (token, parentId, itemId) => dispatch(fetchItem(token, parentId, itemId)),
    updateItem: (token, parentId, itemId, data) => dispatch(updateItem(token, parentId, itemId, data)),
    deleteDate: (token, id, itemId) => dispatch(deleteDate(token, id, itemId))
})

export const calendarItemPending = () => ({
    type: ActionTypes.CALENDAR_ITEM_PENDING
})

export const calendarItemSuccess = (data, children, guardians) => ({
    type: ActionTypes.CALENDAR_ITEM_SUCCESS,
    item: data, 
    children: children,
    guardians: guardians
})

export const calendarItemError = (error) => ({
    type: ActionTypes.CALENDAR_ITEM_ERROR,
    error: error
})

export const editCalendar = () => ({
    type: ActionTypes.CALENDAR_UPDATING
})

export const editCalendarSuccess = (data) => ({
    type: ActionTypes.CALENDAR_UPDATE_SUCCESS,
    data: data, 
})

export const editCalendarError = (error) => ({
    type: ActionTypes.CALENDAR_UPDATE_ERROR,
    error: error
})

export const deleteCalendar = () => ({
    type: ActionTypes.DELETE_PENDING
})

export const deleteSuccess = (data) => ({
    type: ActionTypes.DELETE_SUCCESS,
    data: data
})

export const deleteError = (error) => ({
    type: ActionTypes.DELETE_ERROR,
    error: error
})

export const fetchItem = (token, parentId, itemId) => {
    console.log('URL',`${URL}parents/${parentId}/show/${itemId}` )
    return dispatch => {
        dispatch(calendarItemPending())
        axios.get(`${URL}parents/${parentId}/calendar/show/${itemId}`, {headers: {'Authorization': `Bearer ${token}`}})
        .then(response => {
            dispatch(calendarItemSuccess(response.data.item, response.data.children, response.data.guardians));
        })
        .catch(error => {
            dispatch(calendarItemError(error))
        });
    }
}

export const updateItem = (token, parentId, itemId, data) => {
    return dispatch => {
        dispatch(editCalendar())
        axios.patch(`${URL}parents/${parentId}/calendar/update/${itemId}`, JSON.stringify(data), {headers: {'Content-Type': 'application/json', 'Authorization': `Bearer ${token}`}})
        .then(response => {
            dispatch(editCalendarSuccess(response.data));
            Actions.pop();
        })
        .catch(error => {
            dispatch(editCalendarError(error))
        });
    }
}

export const deleteDate = (token, id, itemId) => {
    console.log(`${URL}parents/${id}/calendar/delete/${itemId}`);
    return dispatch => {
        dispatch(deleteCalendar())
        axios.get(`${URL}parents/${id}/calendar/delete/${itemId}`, {headers: {'Authorization': `Bearer ${token}`}})
        .then(response => {
            dispatch(deleteSuccess(response.data));
             Actions.pop();
        })
        .catch(error => {
            dispatch(deleteError(error))
        });
    }
}
export default connect(mapStateToProps, mapDispatchToProps)(UpdateCalendarService);



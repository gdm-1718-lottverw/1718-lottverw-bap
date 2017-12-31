import * as Actions from '../Actions/ActionTypes'

const CalendarReducer = (state = { isLoading: false, error: undefined, data: {}, deleting: false, deleted: false, updating: false, updated: false, item: {}, children: [] }, action) => {
    switch (action.type) {
        case Actions.CALENDAR_PENDING:
            return Object.assign({}, state, {
                isLoading: true,
            });
        case Actions.CALENDAR_ERROR:
            return Object.assign({}, state, {
                isLoading: false,
                error: action.error
            });
        case Actions.CALENDAR_SUCCESS:
            return Object.assign({}, state, {
                isLoading: false,
                loggedIn: true,
                data: action.data,
            }); 
        case Actions.DELETE_PENDING:
            return Object.assign({}, state, {
                deleting: true,
            });
        case Actions.DELETE_ERROR:
            return Object.assign({}, state, {
                deleted: false,
                error: action.error
            });
        case Actions.DELETE_SUCCESS:
            return Object.assign({}, state, {
                deleted: true,
                data: action.data,
            }); 
        case Actions.CALENDAR_ITEM_PENDING:
            return Object.assign({}, state, {
                isLoading: true,
            });
        case Actions.CALENDAR_ITEM_PERROR:
            return Object.assign({}, state, {
                isLoading: false,
                error: action.error
            });
        case Actions.CALENDAR_ITEM_SUCCESS:
            return Object.assign({}, state, {
                isLoading: true,
                item: action.item,
                children: action.children
            }); 
         case Actions.CALENDAR_UPDATING:
            return Object.assign({}, state, {
                updating: true,
            });
        case Actions.CALENDAR_UPDATE_ERROR:
            return Object.assign({}, state, {
                updated: false,
                error: action.error
            });
        case Actions.CHILDREN_UPDATE_SUCCESS:
            return Object.assign({}, state, {
                updates: true,
                item: action.data,
            }); 
        default:
            return state;
    }
}

export default CalendarReducer;

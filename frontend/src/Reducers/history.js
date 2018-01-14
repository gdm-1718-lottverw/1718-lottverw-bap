import * as Actions from '../Actions/ActionTypes'

const HistoryReducer = (state = { isLoading: false, error: undefined, data: {} }, action) => {
    switch (action.type) {
        case Actions.HISTORY_PENDING:
            return Object.assign({}, state, {
                isLoading: true,
            });
        case Actions.HISTORY_ERROR:
            return Object.assign({}, state, {
                isLoading: false,
                error: action.error
            });
        case Actions.HISTORY_SUCCESS:
            return Object.assign({}, state, {
                isLoading: false,
                data: action.data,
            }); 
        default:
            return state;
    }
}

export default HistoryReducer;
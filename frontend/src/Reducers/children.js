import * as Actions from '../Actions/ActionTypes'

const ChildrenReducer = (state = { isLoading: false, error: undefined, data: {} }, action) => {
    switch (action.type) {
        case Actions.CHILDREN_PENDING:
            return Object.assign({}, state, {
                isLoading: true,
            });
        case Actions.CHILDREN_ERROR:
            return Object.assign({}, state, {
                isLoading: false,
                error: action.error
            });
        case Actions.CHILDREN_SUCCESS:
            return Object.assign({}, state, {
                isLoading: false,
                loggedIn: true,
                data: action.data,
            }); 
        default:
            return state;
    }
}

export default ChildrenReducer;
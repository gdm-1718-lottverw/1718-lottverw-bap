import * as Actions from '../Actions/actionTypes'

const AuthReducer = (state = { isLoading: false, error: undefined, loggedIn: false, credentials: {} }, action) => {
    switch (action.type) {
        case Actions.SERVICE_PENDING:
            return Object.assign({}, state, {
                isLoading: true,
            });
        case Actions.SERVICE_ERROR:
            return Object.assign({}, state, {
                isLoading: false,
                error: action.error
            });
        case Actions.SERVICE_SUCCESS:
            return Object.assign({}, state, {
                isLoading: false,
                loggedIn: true,
                credentials: action.data,
            }); 
        default:
            return state;
    }
}

export default AuthReducer;
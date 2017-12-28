import * as Actions from '../Actions/ActionTypes'

const AuthReducer = (state = { isLoading: false, error: undefined, loggedIn: false, credentials: {}, token: '', id: '' }, action) => {
    switch (action.type) {
        case Actions.LOGGING_IN:
            return Object.assign({}, state, {
                isLoading: true,
            });
        case Actions.LOGIN_ERROR:
            return Object.assign({}, state, {
                isLoading: false,
                error: action.error
            });
        case Actions.LOGIN_SUCCESS:
            return Object.assign({}, state, {
                isLoading: false,
                loggedIn: true,
                token: action.data.token,
                id: action.data.parent,
            }); 
        default:
            return state;
    }
}

export default AuthReducer;
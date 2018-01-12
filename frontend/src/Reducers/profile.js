import * as Actions from '../Actions/ActionTypes'

const ProfileReducer = (state = { isLoading: false, error: undefined, data: {} }, action) => {
    switch (action.type) {
        case Actions.PROFILE_PENDING:
            return Object.assign({}, state, {
                isLoading: true,
            });
        case Actions.PROFILE_ERROR:
            return Object.assign({}, state, {
                isLoading: false,
                error: action.error
            });
        case Actions.PROFILE_SUCCESS:
            return Object.assign({}, state, {
                isLoading: false,
                data: action.data,
            }); 
        case Actions.PROFILE_UPDATING:
            return Object.assign({}, state, {
                isLoading: true,
            });
        case Actions.PROFILE_UPDATE_ERROR:
            return Object.assign({}, state, {
                isLoading: false,
                error: action.error
            });
        case Actions.PROFILE_UPDATE_SUCCESS:
            return Object.assign({}, state, {
                isLoading: false
            }); 
        default:
            return state;
    }
}

export default ProfileReducer;
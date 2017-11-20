import { combineReducers } from 'redux';

function name( state = '', action) {
    switch(action.type){
        case 'UPDATE_PROFILE':
            return action.name;
        default:
            return state;
    }
}

const AppReducers = combineReducers({
    name,
});

export default AppReducers;
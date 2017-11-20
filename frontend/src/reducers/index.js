import { combineReducers } from 'redux';

function name( state = '', action) {
    switch(action.type){
        case 'UPDATE_PROFILE':
            return action.name;
        case 'SEND':
            return [
                ...state, 
                { name: action.name, timestamp: action.timestamp, isOwnName: true },
            ]
        case 'SEND_DONE':
            return '';
        default:
            return state;
    }
}

function child(state = {}, action){
    switch(action.type){
        case 'RECEIVED_CHILD':
            return [
                ...state, 
                action.child, 
            ]
        default:
            return state;
    }
}

const AppReducers = combineReducers({
    name,
    child
});

export default AppReducers;
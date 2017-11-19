import { combineReducers} from 'redux';
function name (state = '', action){
    switch (action.type){
        case 'UPDATED_NAME': 
            return action.name
        default:
            return state
    }
}

const NowReducers = combineReducers({
    name,
})

export default NowReducers;
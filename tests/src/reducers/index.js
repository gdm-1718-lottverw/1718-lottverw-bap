import { combineReducers } from 'redux';
import { childReducer } from './childReducer';

const AppReducers = combineReducers({
    child: childReducer
});

export default AppReducers;
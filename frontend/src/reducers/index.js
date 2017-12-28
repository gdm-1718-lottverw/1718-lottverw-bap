import { combineReducers, applyMiddleware, createStore, compose } from 'redux';
import thunk from 'redux-thunk';
import createLogger from 'redux-logger';

import authReducer from './auth';
import serviceReducer from './serviceReducer';
import calendarReducer from './calendar';
import childrendReducer from './children';

const AppReducers = combineReducers({
    child: serviceReducer,
    auth: authReducer,
    calendar: calendarReducer,
    children: childrendReducer
});

const rootReducer = (state, action) => {
	return AppReducers(state,action);
}

const logger = createLogger();
let store = createStore(rootReducer, compose(applyMiddleware(thunk, logger)));

export default store;


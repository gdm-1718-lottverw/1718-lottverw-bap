import { combineReducers, applyMiddleware, createStore, compose } from 'redux';
import thunk from 'redux-thunk';
import createLogger from 'redux-logger';

import authReducer from './auth';
import calendarReducer from './calendar';
import HistoryReducer from './history';
import ProfileReducer from './profile';
import childrenReducer from './children';
import SubmitAttendanceReducer from './submitAttendance';

const AppReducers = combineReducers({
    auth: authReducer,
    calendar: calendarReducer,
    children: childrenReducer,
    history: HistoryReducer,
    profile: ProfileReducer,
    submitAttendance: SubmitAttendanceReducer,
});

const rootReducer = (state, action) => {
	return AppReducers(state,action);
}

const logger = createLogger();
let store = createStore(rootReducer, compose(applyMiddleware(thunk, logger)));

export default store;


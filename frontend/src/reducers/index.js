import { combineReducers, applyMiddleware, createStore, compose } from 'redux';
import thunk from 'redux-thunk';
import createLogger from 'redux-logger';

import sceneReducer from './routes';
import serviceReducer from './serviceReducer'

const AppReducers = combineReducers({
    serviceReducer,
   // sceneReducer
});

const rootReducer = (state, action) => {
	return AppReducers(state,action);
}


const logger = createLogger();
let store = createStore(rootReducer, compose(applyMiddleware(thunk, logger)));

export default store;


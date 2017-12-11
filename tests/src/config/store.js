import { applyMiddleware, createStore } from 'redux';
import AppReducers from '../reducers/index';
import thunk from 'redux-thunk';

const store = createStore(AppReducers, applyMiddleware(thunk))
export default store;

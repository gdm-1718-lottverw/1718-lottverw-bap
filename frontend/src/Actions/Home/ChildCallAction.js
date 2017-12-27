import * as ActionTypes from '../ActionTypes';
import axios from 'axios';
import ChildCard from '../../Components/Home/ChildCard/index';
import { AsyncStorage } from 'react-native';
import { connect } from 'react-redux';
import { URL } from '../../Config/index';

let TOKEN; let ID;
const mapStateToProps = (state) => ({
    isLoading: state.child.isLoading,
    error: state.child.error,
    data: state.child.data
});

const mapDispatchToProps = (dispatch) => ({
    getTokens: () => getToken(dispatch),
    callService: () => dispatch(callWebservice())
})

export const callWebservice = () => {
    console.log(`${URL}parents/${this.ID}/children/planning`, this.TOKEN);
    return dispatch => {
        dispatch(serviceActionPending())
        axios.get(`${URL}parents/${this.ID}/children/planning`, {headers: {'Authorization': `Bearer ${this.TOKEN}`}})
        .then(response => {
            dispatch(serviceActionSuccess(response.data))
            
        })
        .catch(error => {
            dispatch(serviceActionError(error))
        });
    }
}
const getToken = async (dispatch) => {
    try {
        let cre = await AsyncStorage.getItem('parent');
        let parent = JSON.parse(cre);
        this.TOKEN = parent.token;
        this.ID = parent.parent_id;
        dispatch(callWebservice());
        console.log('TOKEN AND PAREND STK', this.TOKEN, this.ID);
    }
    catch (error){console.log(error)}
}
export const serviceActionPending = () => ({
    type: ActionTypes.SERVICE_PENDING
})

export const serviceActionError = (error) => ({
    type: ActionTypes.SERVICE_ERROR,
    error: error
})

export const serviceActionSuccess = (data) => ({
    type: ActionTypes.SERVICE_SUCCESS,
    data: data
})

export default connect(mapStateToProps, mapDispatchToProps)(ChildCard);
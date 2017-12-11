import axios from 'axios';
export function fetchChild(){
    return (dispatch) => {
        axios.get(`http://192.168.1.155:8000/api/child/3`)
            .then((response) => { 
                console.log(response)
                dispatch({type: "FETCH_CHILD_FULFILLED", payload: response.data})})
            .catch((error) => { 
                console.log(error)
                dispatch({type: "FETCH_CHILD_FAILED", payload: error})})
    }
}

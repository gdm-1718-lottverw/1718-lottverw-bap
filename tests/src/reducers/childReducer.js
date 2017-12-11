export const childReducer = ( state = { 
        data: {}, 
        fetching: false, 
        fetched: false, 
        error: null
        }, action) => {
    switch(action.type){
        case 'FETCH_CHILD': 
            return {
                 ...state,
                 fetching: true
            }
        case 'FETCH_CHILD_FULFILLED': 
            return {
                 fetching: false, 
                 fetched: true, 
                 data: action.payload
            }
        case 'FETCH_CHILD_FAILED': 
            return {
                 ...state,
                 fetching: true, 
                 error: action.payload
            }
        default:
            return state;
    }
}


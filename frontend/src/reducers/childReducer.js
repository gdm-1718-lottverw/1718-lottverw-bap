export const childReducer = ( state = { 
        child: {}, 
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
                 ...state,
                 fetching: false, 
                 child: action.payload
            }
        case 'FETCH_CHILD_FAILED': 
            return {
                 ...state,
                 fetching: false, 
                 error: action.payload
            }
        default:
            return state;
    }
}


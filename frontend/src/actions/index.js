export function updateProfile(name) {
    return {
        type: 'UPDATE_PROFILE', 
        name
    }
}

export function send(timestamp){
    return (dispatch, getState) => {
        dispatch({
            type: 'SEND', 
            name: getState().name,
            timestamp,
        })
    }
}

export function recievedChild(child){
    console.log('action ', child);
    return {
        type: 'RECEIVED_CHILD', 
        child, 
    }
}
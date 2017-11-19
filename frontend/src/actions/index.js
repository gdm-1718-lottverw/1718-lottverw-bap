// simpel object with a type member. 
export function update(name){
    return {
        type: 'UPDATED_NAME',
        name,
    }
}
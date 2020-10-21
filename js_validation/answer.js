
const text = document.getElementById('form9')
const error5 = document.getElementById('error5')
const form5 = document.getElementById('ques2')

form5.addEventListener('submit', (ev) => {
    let messages4 = []


    if(text.value === '' || text.value == null) {
        messages4.push('Your answer cannot be blank')
    }
    if(text.value.length < 5) {
    	messages4.push('Your answer must be longer than 5')
    }



    if(messages4.length > 0) {
        ev.preventDefault()
        error5.innerText = messages4.join('\n ')
    }

})
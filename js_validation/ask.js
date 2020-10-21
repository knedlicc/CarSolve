const title = document.getElementById('form8')
const text = document.getElementById('form9')
const error4 = document.getElementById('error4')
const form4 = document.getElementById('form')

form4.addEventListener('submit', (ev) => {
    let messages3 = []

    if(title.value === '' || title.value == null) {
        messages3.push('Title cannot be blank')
    }
    if(title.value.length < 10) {
        messages3.push('Your title must be longer')
    }
    if(text.value === '' || text.value == null) {
        messages3.push('Your message cannot be blank')
    }

    if(text.value.length < 10) {
        messages3.push('Your description must be longer')
    }

    



    if(messages3.length > 0) {
        ev.preventDefault()
        error4.innerText = messages3.join('\n ')
    }

})
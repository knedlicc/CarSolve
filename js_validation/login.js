const email_login = document.getElementById('eqmail')
const pass_login = document.getElementById('defaultRegisterFormPassword')
const error3 = document.getElementById('error3')
const form3 = document.getElementById('form')

form3.addEventListener('submit', (ev) => {
    let messages2 = []

    if(email_login.value === '' || email_login.value == null) {
        messages2.push('Email cannot be blank')
    }

    if(pass_login.value === '' || pass_login.value == null) {
        messages2.push('Your password cannot be blank')
    }

    if(pass_login.value.length < 6) {
        messages2.push('Password must be at least 6')
    }



    if(messages2.length > 0) {
        ev.preventDefault()
        error3.innerText = messages2.join('\n ')
    }

})
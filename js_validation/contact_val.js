const email_contact = document.getElementById('form8')
const contact_text = document.getElementById('form81')
const error2 = document.getElementById('error2')
const form2 = document.getElementById('form')

form2.addEventListener('submit', (ev) => {
    let messages1 = []

    if(email_contact.value === '' || email_contact.value == null) {
        messages1.push('Email cannot be blank')
    }

    if(contact_text.value === '' || contact_text.value == null) {
        messages1.push('Your message cannot be blank')
    }
    // if(contact_text.value.length < 10 && contact_text.value !== '' && contact_text.value != null) {
    //     messages1.push("Your message must be longer")
    // }



    if(messages1.length > 0) {
        ev.preventDefault()
        error2.innerText = messages1.join('\n ')
    }

})


const name = document.getElementById('FirstName')
const name2 = document.getElementById('LastName')
const email = document.getElementById('email')
const pass= document.getElementById('password1')
const form = document.getElementById('form')
const error = document.getElementById('error1')
const confirm = document.getElementById('confirm_password')




form.addEventListener('submit', (e) => {
    let messages = []
    if(name.value === '' || name.value == null) {
        messages.push('First name cannot be blank')
    }
    if(name.value.length < 2) {

        messages.push('Name must be at least 2 characters'); 
        
    }
    if(name2.value === '' || name2.value == null) {
        messages.push('Last name cannot be blank')
    }
    if(name2.value.length < 2) {
        messages.push('Lastname must be at least 2 characters');   
    }

    if(email.value === '' || email.value == null) {
        messages.push('Email cannot be blank')
    }
    

    if(pass.value.length < 8) {
        messages.push('Password must be at least 6 characters')
    }

    if(pass.value.length > 30) {
        messages.push('Password must be max 30 characters')
    }
   

    if(messages.length > 0) {
        e.preventDefault()
        name.blur()
        error.innerText = messages.join('\n ')
    }

})

var password = document.getElementById("password1"),
confirm_password = document.getElementById("confirm_password");
function validatePassword(){
    if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords don't match");
    } else {
    confirm_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;



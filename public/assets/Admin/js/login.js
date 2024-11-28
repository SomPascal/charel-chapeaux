import { checkField, showPasswords } from "./Utils/form.js"
import { env, getCsrfToken, setCsrfToken } from "./Utils/util.js"

const handleForm = ()=> {

    const loginForm = document.querySelector('#login')
    
    if (! loginForm) {
        return
    }
    
    showPasswords(loginForm)
    
    const email = document.querySelector('#email')
    const password = document.querySelector('#password')
    const remember = document.querySelector('#remember')

    email.addEventListener('blur', (e)=> {
        e.preventDefault()

        checkField(email, 'email')
    })

    password.addEventListener('blur', (e)=> {
        e.preventDefault()
        checkField(password, 'password')
    })

    loginForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        let data
        
        if (! (checkField(email, 'email') && checkField(password, 'password')))
        {
            return
        }

        data = {
            'email': email.value?.trim() ?? '',
            'password': password.value?.trim() ?? '',
            'remember': remember.checked ? 'on' : 'off'
        }

        fetch(loginForm.getAttribute('action'), {
            'method': loginForm.getAttribute('method'),
            'cache': 'no-cache',
            'headers': {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            'body': JSON.stringify(data)
        })
        .then(response => {
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            console.log(response)
        })
    })
}

document.addEventListener('DOMContentLoaded', ()=>{
    handleForm()
})
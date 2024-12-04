import { checkField, clearPassword, disable, setAlert, setErrMsg, showPasswords } from "./Utils/form.js"
import { env, getCsrfToken, setCsrfToken } from "./Utils/util.js"

const handleForm = ()=> {
    const registerForm = document.querySelector('#register')

    if (! registerForm) {
        return
    }

    showPasswords(registerForm)
    
    const username = document.querySelector('#username')
    const email = document.querySelector('#email')
    const password = document.querySelector('#password')
    const passwordConfirm = document.querySelector('#password-confirm')
    const remember = document.querySelector('#remember')

    email.addEventListener('blur', (e)=> {
        e.preventDefault()

        checkField(email, 'email')
    })

    password.addEventListener('blur', (e)=> {
        e.preventDefault()
        checkField(password, 'password')
    })

    username.addEventListener('blur', (e)=> {
        e.preventDefault()
        checkField(username, 'username')
    })

    passwordConfirm.addEventListener('blur', (e)=> {
        e.preventDefault()

        checkField(
            passwordConfirm, 
            'password-confirm',
            true,
            password,
            'password'
        )
    })

    registerForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        let data
        
        disable(registerForm)
        setAlert(registerForm, '', false)

        if (! (
            checkField(username, 'username') &&
            checkField(email, 'email') && 
            checkField(password, 'password')) &&
            checkField(passwordConfirm, 'password-confirm')
        )
        {
            return
        }

        data = {
            'username': username.value?.trim() ?? '',
            'email': email.value?.trim() ?? '',
            'password': password.value?.trim() ?? '',
            'password_confirm': passwordConfirm.value?.trim() ?? '',
            'remember': remember.checked ? 'on' : 'off'
        }

        fetch(registerForm.getAttribute('action'), {
            'method': registerForm.getAttribute('method'),
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
            disable(registerForm, false)
            clearPassword(registerForm)

            let sec 

            switch (response.status) {
                case env.HTTP_CREATED:
                    window.location = response.headers.get(env.X_REDIRECT_TO)
                    break
                
                case env.HTTP_BAD_REQUEST:
                    return response.json()
                    break

                case env.HTTP_TOO_MANY_REQUEST:
                    sec = response.headers.get(env.X_RETRY_AFTER) ?? 5

                    setAlert(
                        registerForm,
                        `Trop de requetes. Réessayez dans ${sec} secondes.`
                    )
                    break

                case env.HTTP_FORBIDDEN:
                    setAlert(
                        registerForm, 
                        'Une erreur est survenue. Veuillez recharger la page.'
                    )

                    break
                
                case env.HTTP_INTERNAL_SERVER_ERROR:
                    setAlert(
                        registerForm,
                        'Une erreur est survenue. Veuillez rééssayer de nouveau'
                    )

                    break

                case env.HTTP_UNAUTHORIZED:
                    setAlert(
                        registerForm,
                        response.statusText
                    )

                    break

                default:
                    setAlert(
                        registerForm,
                        'Une erreur est survenue. Veuillez réessayez'
                    )

                    break
            }
        })
        .then(json => {
            if (json == undefined || json.status != env.HTTP_BAD_REQUEST) {
                return
            }

            for (const id in json.messages) {
                if (Object.prototype.hasOwnProperty.call(json.messages, id)) {
                    setErrMsg(
                        document.querySelector('#' + id),
                        json.messages[id]
                    )
                }
            }
        })
    })
}

document.addEventListener('DOMContentLoaded', ()=> {
    handleForm()
})
import { checkField, clearPassword, disable, setAlert, setErrMsg, showPasswords } from "./Utils/form.js"
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

        disable(loginForm)
        setAlert(loginForm, '', false)

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
            let sec 

            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            disable(loginForm, false)
            clearPassword(loginForm)

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
                        loginForm,
                        `Trop de requetes. Réessayez dans ${sec} secondes.`
                    )
                    break

                case env.HTTP_FORBIDDEN:
                    setAlert(
                        loginForm, 
                        'Une erreur est survenue. Veuillez recharger la page.'
                    )

                    break
                
                case env.HTTP_INTERNAL_SERVER_ERROR:
                    setAlert(
                        loginForm,
                        'Une erreur est survenue. Veuillez rééssayer de nouveau'
                    )

                    break

                case env.HTTP_UNAUTHORIZED:
                    setAlert(
                        loginForm,
                        response.statusText
                    )

                    break

                default:
                    setAlert(
                        loginForm,
                        'Une erreur est survenue. Veuillez réessayez'
                    )

                    break
            }
        })
        .then(json => {
            if (json == undefined || json.status != 400) {
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

document.addEventListener('DOMContentLoaded', ()=>{
    handleForm()
})
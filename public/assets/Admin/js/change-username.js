import { 
    checkField, 
    clearPassword, 
    disable, 
    setAlert, 
    setErrMsg, 
    showPasswords 
} from "./Utils/form.js"

import { env, getCsrfToken, setCsrfToken } from "./Utils/util.js"

document.addEventListener('DOMContentLoaded', ()=> {
    const changeUsernameForm = document.querySelector('#change-username')

    const newUsername = document.querySelector('#username')
    const password = document.querySelector('#password')

    if (! changeUsernameForm) {
        return
    }

    showPasswords(changeUsernameForm)

    newUsername.addEventListener('blur', ()=> {
        checkField(newUsername, 'username')
    })

    password.addEventListener('blur', ()=> {
        checkField(password, 'password')
    })
    
    changeUsernameForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        let data

        if (! 
            (checkField(newUsername, 'username') && 
            checkField(password, 'password'))
        )
        {
            return    
        }
        
        data = {
            'username': newUsername.value?.trim() ?? '',
            'password': password.value?.trim() ?? ''
        }

        disable(changeUsernameForm)
        setAlert(changeUsernameForm, '', false)

        fetch(changeUsernameForm.getAttribute('action'), {
            'method': changeUsernameForm.getAttribute('method'),
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

            disable(changeUsernameForm, false)
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            clearPassword(changeUsernameForm)

            switch (response.status) {
                case env.HTTP_OK:
                    window.location = response.headers.get(env.X_REDIRECT_TO) ?? '/'
                    break
                
                case env.HTTP_BAD_REQUEST:
                    return response.json()
                    break

                case env.HTTP_TOO_MANY_REQUEST:
                    sec = response.headers.get(env.X_RETRY_AFTER) ?? 5

                    setAlert(
                        changeUsernameForm,
                        `Trop de requetes. Réessayez dans ${sec} secondes.`
                    )
                    break

                case env.HTTP_FORBIDDEN:
                    setAlert(
                        changeUsernameForm, 
                        'Une erreur est survenue. Veuillez recharger la page.'
                    )

                    break
                
                case env.HTTP_INTERNAL_SERVER_ERROR:
                    setAlert(
                        changeUsernameForm,
                        'Une erreur est survenue. Veuillez rééssayer de nouveau'
                    )

                    break

                case env.HTTP_UNAUTHORIZED:
                    setAlert(
                        changeUsernameForm,
                        response.statusText
                    )

                    break

                default:
                    setAlert(
                        changeUsernameForm,
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
})
import { checkField, clearPassword, disable, setAlert, setErrMsg, showPasswords } from "./Utils/form.js"
import { env, getCsrfToken, setCsrfToken } from "./Utils/util.js"

document.addEventListener('DOMContentLoaded', ()=> {
    const changePasswordForm = document.querySelector('#change-password')

    const currentPassword = document.querySelector('#current-password')
    const newPassword = document.querySelector('#new-password')
    const newPasswordConfirm = document.querySelector('#new-password-confirm')

    if (! changePasswordForm) {
        return
    }

    showPasswords(changePasswordForm)

    currentPassword.addEventListener('blur', ()=> {
        checkField(currentPassword, 'current-password')
    })

    newPassword.addEventListener('blur', ()=> {
        checkField(newPassword, 'new-password')
    })

    newPasswordConfirm.addEventListener('blur', ()=> {
        checkField(
            newPasswordConfirm, 
            'new-password-confirm',
            true,
            newPassword,
            'new-password'
        )
    })

    changePasswordForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        let data

        if (!
            (checkField(currentPassword, 'current-password') && 
            checkField(newPassword, 'new-password') && 
            checkField(
                newPasswordConfirm, 
                'new-password-confirm',
                true,
                newPassword,
                'new-password'
            ))
        ) 
        {
            return
        }

        disable(changePasswordForm)
        setAlert(changePasswordForm, '', false)

        data = {
            'current-password': currentPassword.value?.trim() ?? '',
            'new-password': newPassword.value?.trim() ?? '',
            'new-password-confirm': newPasswordConfirm.value?.trim() ?? ''
        }

        fetch(changePasswordForm.getAttribute('action'), {
            'method': changePasswordForm.getAttribute('method'),
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
            disable(changePasswordForm, false)
            clearPassword(changePasswordForm)

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
                        changePasswordForm,
                        `Trop de requetes. Réessayez dans ${sec} secondes.`
                    )
                    break

                case env.HTTP_FORBIDDEN:
                    setAlert(
                        changePasswordForm, 
                        'Une erreur est survenue. Veuillez recharger la page.'
                    )

                    break
                
                case env.HTTP_INTERNAL_SERVER_ERROR:
                    setAlert(
                        changePasswordForm,
                        'Une erreur est survenue. Veuillez rééssayer de nouveau'
                    )

                    break

                case env.HTTP_UNAUTHORIZED:
                    setAlert(
                        changePasswordForm,
                        response.statusText
                    )

                    break

                default:
                    setAlert(
                        changePasswordForm,
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
import { checkField, disable, setAlert, setErrMsgFromServer } from "./Utils/form.js"
import { env, getCsrfToken, setCsrfToken } from "./Utils/util.js"

const updateDescription = ()=> {
    const descriptionForm = document.querySelector('#update-description-form')
    const name = document.querySelector('#desc-name')
    const content = document.querySelector('#desc-content')

    content.addEventListener('blur', (e)=> {
        e.preventDefault()

        checkField(content, 'desc-content')
    })

    descriptionForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        if (! checkField(content, 'desc-content')) {
            return
        }

        disable(descriptionForm)
        setAlert(descriptionForm, '', false)

        let data = {
            'desc-name': name.value,
            'desc-content': content.value
        }

        fetch(descriptionForm.getAttribute('action'), {
            'method': descriptionForm.getAttribute('method'),
            'cache': 'no-cache',
            'headers': {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'X-Requested-With': 'XMLHttpRequest'
            },
            'body': JSON.stringify(data)
        })
        .then(response => {
            let sec 

            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            disable(descriptionForm, false)
            console.log(response)

            if (response.ok) {
                window.location = response.headers.get(env.X_REDIRECT_TO) ?? '/admin'
            }
            else if (response.status == env.HTTP_BAD_REQUEST) {
                return response.json()
            }
            else if (response.status == env.HTTP_TOO_MANY_REQUEST) {
                sec = response.headers.get(env.X_RETRY_AFTER)

                setAlert(
                    descriptionForm,
                    `Trop d'essaies, veuillez essayer de nouveau dans ${sec} secondes`
                )
            }
            else if (response.status == env.HTTP_FORBIDDEN) {
                setAlert(
                    descriptionForm,
                    'Une erreur inattendue c\'est produite. Veuillez recharger cette page.'
                )
            }
            else {
                setAlert(
                    descriptionForm,
                    'Une erreur est survenue. Veuillez essayer de nouveau.'
                )
            }
        })
        .then(json => {
            if (json == undefined) {
                return
            }

            if (json.status == env.HTTP_BAD_REQUEST) {
                setErrMsgFromServer(json.messages)
            }
        })
    })

    
}

document.addEventListener('DOMContentLoaded', ()=> {
    updateDescription()
})
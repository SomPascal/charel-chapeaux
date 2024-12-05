import { checkField, disable, setAlert } from "./Utils/form.js"
import { env, getCsrfToken, setCsrfToken } from "./Utils/util.js"

const handleForm = ()=> {
    const verifyEmail = document.querySelector('#verify-email')

    if (! verifyEmail)
    {
        return
    }

    const code = document.querySelector('#code')

    code.addEventListener('blur', ()=> {
        checkField(code, 'code')
    })

    code.addEventListener('keydown', (e)=> {        
        console.log(e);
        
        if (! (
            /^([0-9]{1})$/.test(e.key) ||
            e.keyCode == 8 || 
            e.keyCode == 13 || 
            e.ctrlKey == true
        )) {
            e.preventDefault()
        }
    })

    verifyEmail.addEventListener('submit', (e)=> {
        e.preventDefault()

        if (! checkField(code, 'code'))
        {
            return
        }

        disable(verifyEmail)
        setAlert(verifyEmail, '', false)

        fetch(verifyEmail.getAttribute('action'), {
            'method': verifyEmail.getAttribute('method'),
            'cache': 'no-cache',
            'headers': {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            'body': JSON.stringify({'token': code.value})
        })
        .then(response => {
            let sec 
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            disable(verifyEmail, false)

            switch (response.status) {
                case env.HTTP_OK:
                    window.location = response.headers.get(env.X_REDIRECT_TO)

                    return
                    break
            
                case env.HTTP_TOO_MANY_REQUEST:
                    sec = response.headers.get(env.X_RETRY_AFTER)

                    setAlert(
                        verifyEmail, 
                        `Trop d\'essaies, veuillez essayer de nouveau dans ${sec} secondes`
                    )
                    break

                case env.HTTP_BAD_REQUEST:
                    setAlert(
                        verifyEmail, 
                        'Mauvais code. Essayez de nouveau'
                    )
                    break
                default:
                    setAlert(
                        verifyEmail,
                        'Une erreur innattendue c\'est produite. Essayez de nouveau'
                    )
                    break;
            }
        })
    })

    const countdown = ()=> {
        const countdownField = verifyEmail.querySelector('p [resend-after]')
        const resendBtn = verifyEmail.querySelector('button[resend-code]')
        let beginTime = Number(countdownField.innerHTML)
        let currentTime = beginTime

        setInterval(() => {
            if (currentTime < 1) {
                resendBtn.disabled = false
                countdownField.parentNode.innerHTML = 'Vous pouvez renvoyer le code'
                return
            }
            countdownField.innerHTML = --currentTime
        }, 1000)
        resendBtn.addEventListener('click', ()=> window.location.reload())
    }
    countdown()
}
document.addEventListener('DOMContentLoaded', ()=>{
    handleForm()
})
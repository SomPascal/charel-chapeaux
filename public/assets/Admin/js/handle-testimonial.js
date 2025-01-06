import { checkField, disable, setAlert, setErrMsg } from "./Utils/form.js"
import { env, getCsrfToken, setCsrfToken } from "./Utils/util.js"

/**
 * 
 * @param {HTMLFormElement} form 
 * @param {String|undefined} id
 * @param {CallableFunction|undefined} success
 */
const handleTestimonial = (form, id=undefined, success=undefined)=> {
    if (! form) {
        return
    }

    const autor = document.querySelector('#autor')
    const testimonial = document.querySelector('#testimonial')

    autor.addEventListener('blur', (e)=> {
        e.preventDefault()

        checkField(autor, 'autor')
    })

    testimonial.addEventListener('blur', (e)=> {
        e.preventDefault()

        checkField(testimonial, 'testimonial')
    })

    form.addEventListener('submit', (e)=> {
        e.preventDefault()

        disable(form.parentNode)

        if (! (checkField(autor, 'autor') && checkField(testimonial, 'testimonial'))) 
        {
            return
        }
        let data = {
            'autor': autor.value, 
            'testimonial': testimonial.value
        }

        if (id) {
            data['id'] = id
        }

        fetch(form.getAttribute('action'), {
            'method': form.getAttribute('method') ?? 'post',
            'cache': 'no-cache',
            'headers': {
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },

            'body': JSON.stringify(data)
        })
        .then(response => {
            disable(form.parentNode, false)
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            let redirectTo = response.headers.get(env.X_REDIRECT_TO) ?? '/'

            if (response.ok) {
                if (success == undefined) {
                    window.location = redirectTo
                }
                else {
                    success(redirectTo)
                }
            }
            else if (response.status == env.HTTP_BAD_REQUEST) {
                return response.json()
            }
            else if (response.status == env.HTTP_BAD_REQUEST) {
                setAlert(
                    form,
                    'Une erreur est survenue. Essayez de nouveau'
                )
            }
            else {
                setAlert(
                    form,
                    'Une erreur est survenue. Essayez de nouveau'
                )
            }
        })
        .then(json => {
            if (json == undefined) {
                return
            }
            let inputError

            if (json.status == env.HTTP_BAD_REQUEST) {
                for (const id in json.messages) {
                    if (Object.prototype.hasOwnProperty.call(json.messages, id)) {
                        inputError = document.querySelector('#' + id)

                        if (inputError) {
                            setErrMsg(
                                inputError,
                                json.messages[id]
                            )
                        }   
                        else {
                            setAlert(json.messages[id])
                        }
                    }
                }
            }
        })

    })
}

const createTestimonial = ()=> {
    handleTestimonial(document.querySelector('#testimonial-form'))
}

const updateTestimonial = ()=> {
    handleTestimonial(
        document.querySelector('#update-testimonial-form'),
        window.location.pathname.split('/').at(4)
    )
}

document.addEventListener('DOMContentLoaded', ()=> {
    createTestimonial()
    updateTestimonial()
})
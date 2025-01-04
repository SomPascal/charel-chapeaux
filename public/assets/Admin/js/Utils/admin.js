import { checkField, disable, setAlert, setErrMsg } from "./form.js"
import { env, getCsrfToken, setCsrfToken, setNotification } from "./util.js"

/**
 * 
 * @param {CallableFunction} success 
 */
const setCategory = ({success=undefined, modal, name, action, update=false})=> {
    const setCategoryForm = modal.querySelector('form')
    const setCategoryCode = document.querySelector('#category_code')
    const setCategoryDismiss = modal.querySelector('[data-dismiss]')
    
    setCategoryDismiss.addEventListener('click', ()=> {
        setCategoryCode.value = ''
        name.value = ''
    })

    name.addEventListener('blur', ()=> {
        checkField(name, 'category_name')
    })

    modal.querySelectorAll('[data-dismiss]').forEach(btn => {
        btn.addEventListener('click', ()=> {
            name.value = ''
            setErrMsg(name, '', false)
        })
    })

    setCategoryForm.onsubmit = (e)=> {
        e.preventDefault()

        if (! checkField(name, 'category_name')) 
        {
            return     
        }

        disable(setCategoryForm)
        let data = { 'category_name': name.value }

        if (update == true) {
            data['category_code'] = setCategoryCode.value
        }

        fetch(action, {
            'method': 'post',
            'cache': 'no-cache',
            'headers': {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            'body': JSON.stringify(data)
        })
        .then(response => {
            disable(setCategoryForm, false)
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            let sec

            if (response.ok) {
                setCategoryDismiss.click()

                return response.json()
            }
            else if (response.status == env.HTTP_BAD_REQUEST) {
                return response.json()
            }
            else if (response.status == env.HTTP_TOO_MANY_REQUEST) {
                sec = response.headers.get(env.X_RETRY_AFTER)

                setAlert(
                    setCategoryForm,
                    `Trop d\'essaies, essayez dans ${sec ?? 5} secondes`
                )
            }
            else if (response.status == env.HTTP_BAD_REQUEST) {
                setAlert(
                    setCategoryForm, 
                    'Une erreur c\'est produite. Essayez de nouveau'
                )
            }
        })
        .then(json => {
            let message, input

            if (json == undefined) {
                return
            }
            
            if (json.status == env.HTTP_CREATED || json.status == env.HTTP_OK)
            {                
                if (success == undefined) {
                    window.location.reload()
                }
                else {
                    success(json)
                }
                return
            }
            else if (json.status == env.HTTP_BAD_REQUEST && json.messages != undefined)
            {
                for (const id in json.messages) {
                    if (Object.prototype.hasOwnProperty.call(json.messages, id)) {
                        input = document.querySelector('#' + id)
                        message = json.messages[id]

                        if (input) {
                            setErrMsg(
                                input,
                                message
                            )
                        }
                        else {
                            setAlert(
                                setCategoryForm, 
                                message
                            )
                        }
                    }
                }
            }
            
        })
    }
}

/**
 * 
 * @param {HTMLFormElement} form 
 * @param {String} item_id
 * @param {String} key_name
 * @param {CallableFunction|null} success
 */
const setVisibility = (form, id, key_name='id', success=null)=> {
    disable(form)

    let data = {}
    data[key_name] = id

    fetch(form.getAttribute('action'), {
        'method': form.getAttribute('method'),
        'cache': 'no-cache',
        'headers': {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        'body': JSON.stringify(data)
    })
    .then(response => {
        setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
        disable(form, false)

        if (response.ok)
        {
            disable(form, true)
            form.parentNode.querySelector('[data-dismiss]')?.click()
            
            if (success == undefined) {
                window.location.reload()
            }
            else {
                success()
            }
        }
        else {
            setAlert(
                form,
                'Une erreur est survenue. Veuillez essayer de nouveau'
            )
        }
    })
}

export {
    setCategory,
    setVisibility
}
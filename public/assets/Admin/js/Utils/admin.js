import { checkField, disable, setAlert, setErrMsg } from "./form.js"
import { env, getCsrfToken, setCsrfToken, setNotification } from "./util.js"

/**
 * 
 * @param {CallableFunction} success 
 */
const addCategory = (success)=> {
    const categories = document.querySelector('#categories')
    const addCategoryModal = document.querySelector('#add-category')
    const addCategoryForm = addCategoryModal.querySelector('form')
    const addCategoryDismiss = addCategoryModal.querySelector('[data-dismiss]')
    const categoryName = document.querySelector('#category_name')
    
    categoryName.addEventListener('blur', ()=> {
        checkField(categoryName, 'category_name')
    })

    addCategoryModal.querySelectorAll('[data-dismiss]').forEach(btn => {
        btn.addEventListener('click', ()=> {
            categoryName.value = ''
            setErrMsg(categoryName, '', false)
        })
    })

    addCategoryForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        if (! checkField(categoryName, 'category_name')) 
        {
            return     
        }

        disable(addCategoryForm)
        let data = { 'category_name': categoryName.value }

        fetch(addCategoryForm.getAttribute('action'), {
            'method': addCategoryForm.getAttribute('method') ?? 'post',
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
            disable(addCategoryForm, false)
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            let sec

            if (response.ok) {
                addCategoryDismiss.click()

                return response.json()
            }
            else if (response.status == env.HTTP_BAD_REQUEST) {
                return response.json()
            }
            else if (response.status == env.HTTP_TOO_MANY_REQUEST) {
                sec = response.headers.get(env.X_RETRY_AFTER)

                setAlert(
                    addCategoryForm,
                    `Trop d\'essaies, essayez dans ${sec ?? 5} secondes`
                )
            }
            else if (response.status == env.HTTP_BAD_REQUEST) {
                setAlert(
                    addCategoryForm, 
                    'Une erreur c\'est produite. Essayez de nouveau'
                )
            }
        })
        .then(json => {
            if (json == undefined) {
                return
            }
            
            if (json.status == env.HTTP_CREATED)
            {                
                success(json)
            }
            else if (json.status == env.HTTP_BAD_REQUEST && json.messages != undefined)
            {
                for (const id in json.messages) {
                    if (Object.prototype.hasOwnProperty.call(json.messages, id)) {
                        setErrMsg(
                            document.querySelector('#' + id),
                            json.messages[id]
                        )
                    }
                }
            }
            
        })
    })
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
            
            if (success == null) {
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
    addCategory,
    setVisibility
}
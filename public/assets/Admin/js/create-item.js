import { checkField, disable, setAlert, setErrMsg } from "./Utils/form.js"
import { env, getCsrfToken, setCsrfToken, setNotification } from "./Utils/util.js"

const addCategory = ()=> {
    const addCategoryModal = document.querySelector('#add-category')
    const addCategoryForm = addCategoryModal.querySelector('form')
    const addCategoryDismiss = addCategoryModal.querySelector('[data-dismiss]')
    const categoryName = document.querySelector('#category_name')
    const categories = document.querySelector('#categories')
    
    categoryName.addEventListener('blur', ()=> {
        checkField(categoryName, 'category_name')
    })

    const addCategoryIntoList = ({id, name})=> {
        console.log(id, name);
        
        const category = document.createElement('option')

        category.value = id 
        category.innerText = name
        categories.appendChild(category)
    }

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
                addCategoryForm.querySelector('[data-dism]')
                setNotification(`La catégorie ${data.category_name} a été créé avec succès.`)
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
                addCategoryIntoList(json)    
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

document.addEventListener('DOMContentLoaded', ()=> {
    addCategory()
})
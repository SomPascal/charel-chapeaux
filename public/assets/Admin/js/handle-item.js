import { setCategory } from "./Utils/admin.js"
import { checkField, checkFileField, disable, setAlert, setErrMsg } from "./Utils/form.js"
import { env, getCsrfToken, randomString, setCsrfToken, setNotification, showImagePreview } from "./Utils/util.js"

const categories = document.querySelector('#categories')
const imagePreviewBox = document.querySelector('#img-previews-box')
const selectedFiles = {}

const removePreview = ()=> {
    imagePreviewBox.querySelectorAll('li button').forEach(btn => {
        btn.onclick = (e)=> {
            e.preventDefault()

            let previewId = btn.parentNode.getAttribute('id')
            btn.parentNode.remove()
            
            delete selectedFiles[previewId.slice(8)]
        }
    })
}
/**
 * 
 * @param {String} id 
 */
const addPreview = (id)=> {
    const preview = document.createElement('li')

    preview.classList.add('shadow', 'm-2', 'position-relative')
    preview.style.width = '100px'
    preview.id = `preview-${id}`

    preview.innerHTML = `
        <img 
            src="" 
            class="img-fluid rounded" 
            style="min-width: 100px;" 
        />

        <button type="button" class="btn btn-sm btn-danger shadow position-absolute" style="top: 5px;right: 5px;">
            <i class="fa fa-times"></i>
        </button>`

    imagePreviewBox.appendChild(preview)
    removePreview()
}

const recordItem = ()=> {
    const createItemForm = document.querySelector('#create-form form')
    const itemImages = document.querySelector('#item-images')
    const itemName = document.querySelector('#item-name')
    const itemDescription = document.querySelector('#item-description')
    const itemPrice = document.querySelector('#item-price')

    const showItemPics = ()=> {
        itemImages.addEventListener('change', (e)=> {
            if (Object.keys(selectedFiles).length > env.MAX_ITEM_PICS) {
                setErrMsg(
                    itemImages, 
                    'La limite d\'images est de 15.'
                )

                return
            }

            Array.from(itemImages.files).forEach(
                /**
                 * 
                 * @param {File} file 
                 */
                (file) => {
                    if (! checkFileField(file, 'item-images')) {
                        return
                    }
                    const imagePreviewId = randomString()

                    addPreview(imagePreviewId)
                    showImagePreview(`#preview-${imagePreviewId} img`, file)

                    selectedFiles[imagePreviewId] = file
                }
            )
        })
    }

    itemName.addEventListener('blur', ()=> {
        checkField(itemName, 'item-name')
    })

    itemPrice.addEventListener('blur', ()=> {
        checkField(itemPrice, 'item-price')
    })

    itemDescription.addEventListener('blur', ()=> {
        checkField(itemDescription, 'item-description')
    })

    showItemPics()

    createItemForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        disable(createItemForm)

        let data = new FormData()
        data.append('item-name', itemName.value),
        data.append('item-price', itemPrice.value)
        data.append('categories', categories.value)
        data.append('item-description', itemDescription.value)
        
        for (const i in selectedFiles) {
            if (Object.prototype.hasOwnProperty.call(selectedFiles, i)) {
                data.append('item-images[]', selectedFiles[i])
            }
        }
        
        fetch(createItemForm.getAttribute('action'), {
            'method': createItemForm.getAttribute('method'),
            'cache': 'no-cache',
            'headers': {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            'body': data
        })
        .then(response => {
            disable(createItemForm, false)
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))

            if (response.ok) 
            {
                window.location = response.headers.get(env.X_REDIRECT_TO) ?? '/admin'
            }
            else if (response.status == env.HTTP_INTERNAL_SERVER_ERROR) {
                setAlert(
                    createItemForm,
                    'Une erreur est survenue. Veuillez éssayer de nouveau.'
                )
            }
            else if (response.status == env.HTTP_BAD_REQUEST) {
                return response.json()
            }
            else {
                setAlert(
                    createItemForm,
                    'Une erreur est survenue. Veuillez éssayer de nouveau.'
                )
            }
        })
        .then(json => {
            if (json == undefined) {
                return
            }

            if (json.status == env.HTTP_BAD_REQUEST) {
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
    const categoryName = document.querySelector('#category_name')
    const categoryModal = document.querySelector('#add-category')

    setCategory({
        'modal': categoryModal,
        'name': categoryName,
        'action': document.querySelector('#add-category-form').getAttribute('action'),
        'success': ({id, name})=> {
            const category = document.createElement('option')
    
            category.value = id 
            category.innerText = name
            categories.appendChild(category)
            
            setNotification(`La catégories ${name} a été ajouté avec succès.`)
        }
    })
    recordItem()
})
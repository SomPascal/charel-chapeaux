import { setCategory } from "./Utils/admin.js"
import { checkField, checkFileField, disable, setAlert, setErrMsg, setErrMsgFromServer } from "./Utils/form.js"
import { env, getCsrfToken, randomString, setCsrfToken, setNotification, showImagePreview } from "./Utils/util.js"

const handleItemForm = document.querySelector('#handle-item-form')
const categories = document.querySelector('#categories')
const imagePreviewBox = document.querySelector('#img-previews-box')
const selectedFiles = {}
const unselectedItemPics = []
const formRole = handleItemForm.getAttribute('role')

const removePreview = ()=> {
    imagePreviewBox.querySelectorAll('li button').forEach(btn => {
        btn.onclick = (e)=> {
            e.preventDefault()

            let previewId = btn.parentNode.getAttribute('id')
            btn.parentNode.remove()
            
            delete selectedFiles[previewId.slice(8)]

            if (formRole == 'update') {
                unselectedItemPics.push(previewId.slice(8))
                console.log(unselectedItemPics)
                
            }
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

const handleItem = ()=> {
    const itemId = document.querySelector('#item-id')
    const itemImages = document.querySelector('#item-images')
    const itemName = document.querySelector('#item-name')
    const itemDescription = document.querySelector('#item-description')
    const itemPrice = document.querySelector('#item-price')

    removePreview()

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

    handleItemForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        disable(handleItemForm)
        setAlert(handleItemForm, '', false)

        let data = new FormData()
        data.append('item-name', itemName.value),
        data.append('item-price', itemPrice.value)
        data.append('categories', categories.value)
        data.append('item-description', itemDescription.value)

        if (formRole == 'update') {
            data.append('unselected-item-images', JSON.stringify(unselectedItemPics))
            data.append('item-id', itemId.value)
        }
        
        for (const i in selectedFiles) {
            if (Object.prototype.hasOwnProperty.call(selectedFiles, i)) {
                data.append('item-images[]', selectedFiles[i])
            }
        }
        
        fetch(handleItemForm.getAttribute('action'), {
            'method': handleItemForm.getAttribute('method'),
            'cache': 'no-cache',
            'headers': {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            'body': data
        })
        .then(response => {
            disable(handleItemForm, false)
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))

            if (response.ok) 
            {
                window.location = response.headers.get(env.X_REDIRECT_TO) ?? '/admin'
            }
            else if (response.status == env.HTTP_INTERNAL_SERVER_ERROR) {
                setAlert(
                    handleItemForm,
                    'Une erreur est survenue. Veuillez éssayer de nouveau.'
                )
            }
            else if (response.status == env.HTTP_BAD_REQUEST) {
                return response.json()
            }
            else {
                setAlert(
                    handleItemForm,
                    'Une erreur est survenue. Veuillez éssayer de nouveau.'
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

    handleItem()
})
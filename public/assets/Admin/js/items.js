import { addCategory, setVisibility } from "./Utils/admin.js"
import { disable, setAlert } from "./Utils/form.js"
import { env, getCsrfToken, setCsrfToken, setNotification } from "./Utils/util.js"

const listItems = document.querySelector('#list-items')
const listCategories = document.querySelector('#list-categories')

const enableItemSwiper = ()=> {
    listItems.querySelectorAll('.swiper').forEach(list => {
        new Swiper(list, {
            loop: false,
            slidesPerView: 2, 
            spaceBetween: '20px',

            pagination: {
                el: '.swiper-pagination'
            },

            keyboard: {
                enabled: true,
                onlyInViewport: false
            },

            breakpoints: {
                768: {slidesPerView: 3},
                990: {slidesPerView: 4},
                1300: {slidesPerView: 5}
            }
        })
    })
}

const handleItemVisibility = ()=> {
    const hideItemModal = document.querySelector('#hide-item-modal')
    const showItemModal = document.querySelector('#show-item-modal')
    const deleteItemModal = document.querySelector('#delete-item-modal')


    listItems.querySelectorAll('.card').forEach(card => {
        const item_id = card.getAttribute('id').slice(5)

        card.querySelector('button[hide]')?.addEventListener('click', ()=> {
            const hideItemForm = hideItemModal.querySelector('form')

            hideItemModal.querySelector('button[type="submit"]')
            .addEventListener('click', (e)=> {
                e.preventDefault()

                setVisibility(hideItemForm, item_id, 'item_id')
            })
        })

        card.querySelector('button[show]')?.addEventListener('click', ()=> {
            const showItemForm = showItemModal.querySelector('form')

            showItemForm.querySelector('button[type="submit"]')
            .addEventListener('click', (e)=> {
                e.preventDefault()

                setVisibility(showItemForm, item_id, 'item_id')
            })
        })

        card.querySelector('button[delete]')?.addEventListener('click', ()=> {
            const deleteItemForm = deleteItemModal.querySelector('form')

            deleteItemForm.querySelector('button[type="submit"]')
            .addEventListener('click', (e)=> {
                e.preventDefault()

                setVisibility(deleteItemForm, item_id, 'item_id')
            })
        })
    })
}

const handleCategories = ()=> {
    const deleteCategoryModal = document.querySelector('#delete-category-modal')
    const deleteCategoryForm = deleteCategoryModal.querySelector('form')

    addCategory(()=> window.location.reload())

    listCategories.querySelectorAll('li').forEach(category => {        
        category.querySelector('button[delete]')?.addEventListener('click', ()=> {
            deleteCategoryForm.querySelector('button[type="submit"]')
            .addEventListener('click', (e)=> {
                e.preventDefault()
                
                setVisibility(
                    deleteCategoryForm, 
                    category.id.slice(9), 
                    'category_code',
                    ()=> {window.location.reload()}
                )
            })
        })
    })
}

document.addEventListener('DOMContentLoaded', ()=> {
    enableItemSwiper()
    handleItemVisibility()
    handleCategories()
})
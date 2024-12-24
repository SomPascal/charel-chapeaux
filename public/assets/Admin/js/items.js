import { disable, setAlert } from "./Utils/form.js"
import { env, getCsrfToken, setCsrfToken, setNotification } from "./Utils/util.js"

const listItems = document.querySelector('#list-items')

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

    /**
     * 
     * @param {HTMLFormElement} form 
     * @param {String} item_id
     */
    const setVisibility = (form, item_id)=> {
        disable(form)

        fetch(form.getAttribute('action'), {
            'method': form.getAttribute('method'),
            'cache': 'no-cache',
            'headers': {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            'body': JSON.stringify({'item_id': item_id})
        })
        .then(response => {
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            disable(form, false)

            if (response.ok)
            {
                disable(form, true)
                hideItemModal.querySelector('[data-dismiss]')?.click()
                window.location.reload()
            }
            else {
                setAlert(
                    form,
                    'Une erreur est survenue. Veuillez essayer de nouveau'
                )
            }
        })
    }

    listItems.querySelectorAll('.card').forEach(card => {
        const item_id = card.getAttribute('id').slice(5)

        card.querySelector('button[hide]')?.addEventListener('click', ()=> {
            const hideItemForm = hideItemModal.querySelector('form')

            hideItemModal.querySelector('button[type="submit"]')
            .addEventListener('click', (e)=> {
                e.preventDefault()

                setVisibility(hideItemForm, item_id)
            })
        })

        card.querySelector('button[show]')?.addEventListener('click', ()=> {
            const showItemForm = showItemModal.querySelector('form')

            showItemForm.querySelector('button[type="submit"]')
            .addEventListener('click', (e)=> {
                e.preventDefault()

                setVisibility(showItemForm, item_id)
            })
        })

        card.querySelector('button[delete]')?.addEventListener('click', ()=> {
            const deleteItemForm = deleteItemModal.querySelector('form')

            deleteItemForm.querySelector('button[type="submit"]')
            .addEventListener('click', (e)=> {
                e.preventDefault()

                setVisibility(deleteItemForm, item_id)
            })
        })
    })
}

document.addEventListener('DOMContentLoaded', ()=> {
    enableItemSwiper()
    handleItemVisibility()
})
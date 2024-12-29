import { addCategory, setVisibility } from "./Utils/admin.js"
import { disable, setAlert } from "./Utils/form.js"
import { env, getCsrfToken, setCsrfToken, setNotification } from "./Utils/util.js"
import Item from "./Components/Item.js"

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

const searchItems = ()=> {
    const findItemsBox = document.querySelector('#find-items')

    const searchAdminModal = document.querySelector('#search-admin-modal')
    const searchForm = searchAdminModal.querySelector('form')
    const searchTerms = document.querySelector('#search-terms')
    const searchSubmit = document.querySelector('#search-submit')

    const category = document.querySelector('#search-category')
    let previousTerm = null
    let currentTerm = null

    let previousCategory = null

    findItemsBox.querySelector('input').addEventListener('click', (e)=> {
        e.preventDefault()

        document.querySelector('#show-search-item-modal')?.click()
        setTimeout(()=> searchTerms.focus(), 500)
        
    })

    searchTerms.addEventListener('keyup', (e)=> {
        searchSubmit.click()
    })

    searchForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        const searchWelcome = document.querySelector('#search-welcome')
        const searchNoResult = document.querySelector('#search-noresult')
        const searchResults = document.querySelector('#search-results')
        const numberResults = document.querySelector('#number-results')

        if (searchTerms.value.trim() == previousTerm &&
            (category.value == previousCategory)
        )
        {
            if (searchTerms.value.trim() == '') {
                searchWelcome.classList.remove('d-none')
                searchNoResult.classList.add('d-none')
    
                searchResults.classList.add('d-none')
                searchResults.classList.remove('d-flex')
                searchResults.innerHTML = ''
            }

            return
        }


        /**
         * 
         * @param {String} term 
         */
        const setNoResult = (term)=> {
            numberResults.querySelector('span').innerHTML = 0
            searchNoResult.querySelector('span').innerHTML = term
            searchNoResult.classList.remove('d-none')
        }

        /**
         * 
         * @param {Array<Item>} results 
         * @param {String}
         */
        const setResults = (results, term)=> {
            numberResults.classList.remove('d-none')

            searchWelcome.classList.add('d-none')
            searchNoResult.classList.add('d-none')

            searchResults.classList.remove('d-none')
            searchResults.classList.add('d-flex')
            searchResults.innerHTML = ''

            numberResults.querySelector('span').innerHTML = results.length

            if (results.length == 0) {
                setNoResult(term)
                return
            }

            results.forEach(result => {
                let HTMLResult = document.createElement('li')

                HTMLResult.classList.add('card', 'shadow', 'search-result')
                HTMLResult.setAttribute('id', 'item-'.concat(result.id))

                if (Number(result.is_hidden) == 1) {
                    HTMLResult.classList.add('opacity-50')
                }

                HTMLResult.innerHTML = `
                    <a href="/fr/item/${result.id}">
                        <img 
                            src="/item/pic/${result.item_pic_id}" 
                            class="card-img-top img-fluid" 
                            alt="..."
                        />
                    </a>

                    <div class="card-body">
                        <h6 class="card-title h6 fw-bold text-uppercase mb-0" style="font-weight: bold;">
                            ${result.name}
                        </h6>

                        <p class="mb-0">
                            Categorie: ${result.category}
                        </p>

                        <p class="mb-0 fw-bold">
                            ${result.price} F
                        </p>
                    </div>`

                searchResults.appendChild(HTMLResult)
            })
        }

        currentTerm = searchTerms.value.trim()
        previousTerm = currentTerm
        previousCategory = category.value

        fetch(`${searchForm.getAttribute('action')}?term=${currentTerm}&category=${category.value}`, {
            'method': searchForm.getAttribute('method'),
            'cache': 'no-cache',
            'headers': {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(response => {
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))

            if (response.ok) {
                return response.json()
            }
            else {
                setNoResult(currentTerm)
                searchWelcome.classList.remove('d-none')
            }
        })
        .then(results => {
            if (results) {
                setResults(results, currentTerm)
            }
        })
    })
    
}

document.addEventListener('DOMContentLoaded', ()=> {
    enableItemSwiper()
    handleItemVisibility()
    handleCategories()
    searchItems()
})
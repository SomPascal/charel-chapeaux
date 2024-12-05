import { Admin, AdminBag } from "./Components/Admin.js";
import { disable, setAlert } from "./Utils/form.js";
import { copyLink, env, getCsrfToken, setCsrfToken, setNotification } from "./Utils/util.js";

let admins = new AdminBag()

const swiperTestimonials = ()=> {
    const swiper = new Swiper('#testimonials .swiper', {
        // Optional parameters
        loop: false,
        slidesPerView: 1,
        spaceBetween: '50px',

        // responsive behavior
        breakpoints: {
            768: { slidesPerView: 2 }
        },
      
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        },

        keyboard: {
            enabled: true,
            onlyInViewport: false,
        }
    });
    
}

const swiperCapsPopulary = ()=> {
    // const mostPopularSwiper = new Swiper('#most-popular-caps', {
    //     // Optional parameters

    //     loop: false,
    //     slidesPerView: 1,
    //     spaceBetween: '10px',

    //     pagination: {
    //         el: '.swiper-pagination',
    //     },
  
    //     keyboard: {
    //         enabled: true,
    //         onlyInViewport: false
    //     },

    //     breakpoints: {
    //         780: {
    //             slidesPerView: 3,
    //             spaceBetween: '40px'
    //         }
    //     }
    // })

    document.querySelectorAll('#caps-popularity .swiper').forEach(swiper => {
        new Swiper(swiper, {
            loop: false,
            slidesPerView: 1,
            spaceBetween: '10px',

            pagination: {
                el: '.swiper-pagination',
            },
    
            keyboard: {
                enabled: true,
                onlyInViewport: false
            },

            breakpoints: {
                780: {
                    slidesPerView: 3,
                    spaceBetween: '40px'
                }
            }
        })
    })
    
}

const handleDescModal = ()=> {
    const expandDescModal = ()=> {
        let modalTarget, descTarget
        document.querySelectorAll('#site-desc button[data-toggle="modal"]').forEach(btn => {

            btn.addEventListener('click', ()=> {

                modalTarget = document.querySelector(btn.getAttribute('data-target'))

                if (modalTarget == null) {
                    return
                }
                descTarget = btn.parentNode.parentNode.parentNode

                modalTarget.querySelector('.modal-title')
                .innerHTML = descTarget.querySelector('.card-header h5').innerHTML

                modalTarget.querySelector('.modal-body textarea')
                .value = descTarget.querySelector('.card-body textarea').value
            })
        })
    }

    const editDesc = ()=> {
        const extendDescModal = document.querySelector('#extend-desc')
        const editBtn = document.querySelector('#edit-desc')
        const updateBtn = document.querySelector('#update-desc')
        const cancelEditBtn = document.querySelector('#cancel-update-desc')
        const descField = document.querySelector('#desc-text')

        extendDescModal.querySelectorAll('[data-dismiss="modal"]')
        .forEach((btn)=> {
            btn.addEventListener('click', ()=> {
                cancelEditBtn.click()
            })

        })

        extendDescModal.addEventListener('click', ()=> {
            cancelEditBtn.click()
        })

        editBtn.addEventListener('click', ()=> {
            editBtn.parentNode.classList.add('d-none')
            updateBtn.parentNode.classList.remove('d-none')
            descField.removeAttribute('readonly')
        })

        cancelEditBtn.addEventListener('click', (e)=> {
            e.target.parentNode.classList.add('d-none')
            descField.setAttribute('readonly', 'readonly')
            editBtn.parentNode.classList.remove('d-none')
        })

        updateBtn.addEventListener('click', ()=> {
            alert('description saved')
        })
        // console.log(extendDescModal)
    }

    editDesc()
    expandDescModal()
}

const setAdmins = ()=> {    
    admins = AdminBag.getAdmins()    
}

const showAdminDetails= ()=> {
    const adminDetailsModal = document.querySelector('#admin-details')

    const selects = [
        'id', 'invitedBy', 'username', 
        'group', 'email', 'registredAt'
    ]
    let admin

    document.querySelectorAll('[admin-card]').forEach(card => {
        card.querySelector('[show-admin]').addEventListener('click', ()=> {
            admin = admins.findById(card.getAttribute('admin-id'))
            
            if (admin == null)
            {
                adminDetailsModal.querySelector('.modal-body').innerHTML = '<p>Aucune donnée a afficher.</p>'
                return
            }
        
            selects.forEach(sel => {
                const el = document.querySelector(`#detail-${sel}`)
                if (! el) {
                    return 
                }
                el.querySelector('span').innerHTML = admin[sel]
            })
        })

        adminDetailsModal.querySelectorAll('button[data-dismiss]').forEach(btn => {
            btn.addEventListener('click', ()=> {
                selects.forEach(sel => {
                    const el = document.querySelector(`#detail-${sel}`)
                    if (! el) {
                        return 
                    }
                    el.querySelector('span').innerHTML = ''
                })
            })
        })
    })
    
}

const changeAdminGroup = ()=> {
    const changeAdminRoleModal = document.querySelector('#change-admin-role')
    const changeAdminRoleForm = changeAdminRoleModal.querySelector('form')

    const closeBtn = document.querySelector('button[data-dismiss]')
    const alertInfo = changeAdminRoleModal.querySelector('.alert-info')
    let currentAdmin

    /**
     * 
     * @param {String} newGroup 
     */
    const setInfo = ({username, group}, newGroup)=> {
        alertInfo.innerHTML = `Etes vous sur de vouloir modifier le role de ${username}, de "${group}" à "${newGroup}"`
    }

    document.querySelectorAll('[admin-card]').forEach(card => {
        card.querySelectorAll('[admin-role] .dropdown-menu .dropdown-item')
        .forEach(item => {
            if (item.hasAttribute('disabled')) {
                return
            }
            
            item.addEventListener('click', (e)=> {
                e.preventDefault()
                let card = item.parentNode
                .parentNode
                .parentNode
                .parentNode
                .parentNode
                .parentNode
                .parentNode

                currentAdmin = admins.findById(
                    card.getAttribute('admin-id')
                )
        
                if (currentAdmin == null) {
                    return
                }
                setInfo(currentAdmin, item.getAttribute('value'))

                changeAdminRoleModal.querySelector('button[type="submit"]')
                .onclick = (e)=> {
                    e.preventDefault()

                    let data = {
                        'admin_id': currentAdmin.id,
                        'role': item.getAttribute('value')
                    }
                    disable(changeAdminRoleForm)

                    fetch(changeAdminRoleForm.getAttribute('action'), {
                        'method': changeAdminRoleForm.method ?? 'post',
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
                        disable(changeAdminRoleForm, false)
                        setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))

                        if (response.status == env.HTTP_OK) {
                            window.location.reload()
                        }
                        else {
                            setAlert(changeAdminRoleForm, 'Une erreur est survenue.')
                        }
                    })
                }
            })
        })
    })

    changeAdminRoleModal.querySelectorAll('[data-dismiss]').forEach(btn => {
        btn.addEventListener('click', ()=> {
            alertInfo.innerHTML = ''
            changeAdminRoleModal.querySelector('button[type="submit"]').onclick = undefined
        })
    })
}

const generateInviteLink = ()=>{
    const generateLinkForm = document.querySelector('#invite-link-form')

    if (! generateLinkForm)
    {
        return
    }

    const inviteLinkField = document.querySelector('#invite-link-field')
    const inviteLinkRole = document.querySelector('#invite-link-role')
    const copyInviteLink = document.querySelector('#copy-invite-link')

    generateLinkForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        disable(generateLinkForm)
        setAlert(generateLinkForm, '', false)

        const data = {'role': inviteLinkRole.value}

        fetch(generateLinkForm.getAttribute('action'), {
            'cache': 'no-cache',
            'method': generateLinkForm.getAttribute('method'),
            'headers': {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            'body': JSON.stringify(data)
        })
        .then(response => {
            let sec 

            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            disable(generateLinkForm, false)

            if (response.status == env.HTTP_CREATED) {
                return response.json()
            }
            else if (response.status == env.HTTP_TOO_MANY_REQUEST)
            {
                sec = response.headers.get(env.X_RETRY_AFTER)

                setAlert(
                    generateLinkForm,
                    `Trop d'essaies. Veuillez réessayer dans ${sec} seconds.`
                )

                return
            }
            else {
                setAlert(
                    generateLinkForm,
                    'Une erreur est survenue, veuillez essayer de nouveau.'
                )
            }
        })
        .then(json => {
            if (json == undefined) {
                return
            }

            inviteLinkField.value = json.url 
            copyInviteLink.removeAttribute('disabled')
        })
    })

    copyInviteLink.addEventListener('click', ()=> {
        let oldBtn = copyInviteLink.innerHTML
        copyLink(inviteLinkField.value)

        
        setTimeout(()=> {
            copyInviteLink.innerHTML = '<span class="icon"><i class="fa fa-check"></i></span><span class="text">Copied</span>'
        }, 1500)
    })
}

document.addEventListener('DOMContentLoaded', ()=> {
    document.querySelector('#sidebarToggleTop')?.click()
    setAdmins()
    showAdminDetails()
    generateInviteLink()
    changeAdminGroup()
    
    // swiperTestimonials()
    swiperCapsPopulary()
    // handleDescModal()
    // handleLinksModal()

})
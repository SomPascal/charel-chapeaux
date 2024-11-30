class AdminBag
{
    /**
     * 
     * @param {Array<Admin>} admins 
     */
    constructor(admins=[])
    {
        this.admins = admins
    }

    /**
     * @returns {Array<Admin>}
     */
    getAll()
    {
        return this.admins
    }

    /**
     * 
     * @param {Admin} admin 
     */
    add(admin)
    {
        this.admins.push(admin)
    }

    remove({id})
    {
        this.admins = this.admins.filter(admin => admin.id != id)
    }

    /**
     * 
     * @param {Number} id
     * @returns {Admin|null} 
     */
    findById(id)
    {
        let res = null

        for (const admin of this.admins) 
        {
            if (admin.id == id) 
            {
                res = admin
            }
        }

        return res
    }

    /**
     * @returns {AdminBag}
     */
    static getAdmins()
    {
        let admins = new AdminBag()
        let admin

        document.querySelectorAll('[admin-card]').forEach(card => {
            admin = new Admin(
                card.getAttribute('admin-id'),
                card.getAttribute('username'),
                card.getAttribute('email'),
                card.getAttribute('group'),
                card.getAttribute('invitedBy') ?? 'Persone',
                card.getAttribute('myself'),
                card.getAttribute('created-at')
            )
            admins.add(admin)
        })

        return admins
    }
}

class Admin
{
    /**
     * 
     * @param {Number} id 
     * @param {String} username 
     * @param {String} email 
     * @param {String} group 
     * @param {String|null} invitedBy
     * @param {String} mySelf 
     * @param {String} registredAt 
     */
    constructor(id, username, email, group, invitedBy=null, mySelf, registredAt)
    {
        this.id = id
        this.username = username
        this.email = email
        this.group = group
        this.invitedBy = invitedBy
        this.mySelf = mySelf
        this.registredAt = registredAt
    }
}

export {
    AdminBag,
    Admin
}
class Item
{
    constructor({id, name, description, price, is_hidden, item_pic_id, category})
    {
        this.id = id
        this.name = name
        this.description = description
        this.price = price
        this.is_hidden = is_hidden
        this.item_pic_id = item_pic_id

        this.category = category
    }
}

export default Item
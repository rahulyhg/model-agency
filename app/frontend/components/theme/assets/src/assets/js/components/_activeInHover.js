class ActiveInHover {
    constructor(config) {
        this.items = $(config.items)
        this.item = this.items.find($(config.item))
        this.activeClass = config.activeClass

        this.saveActive = this.items.find($('.' + this.activeClass))

        this.item.on('mouseenter', e => {
            $(e.currentTarget).addClass(this.activeClass).siblings().removeClass(this.activeClass)
        })
        this.item.on('click', e => {
            this.saveActive = $(e.currentTarget)
        })
        this.items.on('mouseleave', e => {
            this.saveActive.addClass(this.activeClass).siblings().removeClass(this.activeClass)
        })
    }
}
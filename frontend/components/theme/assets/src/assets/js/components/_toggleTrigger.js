class ToggleTrigger {
    constructor(config, callBack = () => {}) {
        this.items = $(config.items)
        this.item = this.items.find($(config.item))
        this.activeClass = config.activeClass

        this.item.on('click', e => {
            $(e.currentTarget).removeClass(this.activeClass).siblings().addClass(this.activeClass)
            callBack()
        })
    }
}
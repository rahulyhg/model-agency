class AnimFeatures {
    constructor(config) {
        this.parrent = $(config.parrent)
        this.itemTitle = this.parrent.find($(config.itemTitle))
        this.lineTitle = this.parrent.find($(config.lineTitle))
        this.itemValue = this.parrent.find($(config.itemValue))
        this.breakPoints = config.breakPoints

        this.init()
    }

    init() {
        this.update()
        this.handler()
    }

    handler() {
        $(window).on('resize', e => {
            let windowWidth = $(window).width()

            for (let i = 0; i < this.breakPoints.length; i++) {
                if (windowWidth <= this.breakPoints[i]) {
                    this.update()
                }
            }
        })
    }

    update() {
        console.log('update');

        for (let i = 0; i < this.itemTitle.length; i++) {
            let widthTitle = this.itemTitle.eq(i).width()
            let widthValue = this.itemValue.eq(i).width()

            this.lineTitle.eq(i).width((widthTitle + widthValue * 0.4) + 'px')
        }
    }
}
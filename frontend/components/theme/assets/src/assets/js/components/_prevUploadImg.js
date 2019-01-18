class PrevUploadImg {
    constructor(config, callBack = () => {}) {
        this.parent = $(config.parent)
        this.input = this.parent.find($(config.input))
        this.preview = this.parent.find($(config.preview))
        this.extensions = config.extensions
        this.maxSize = config.maxSize

        this.callBack = callBack

        this.init()
    }

    init() {
        this.handler()
    }

    handler() {
        this.input.on('change', e => {
            var url = e.target.value
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            var sizeMb = (e.target.files[0].size / 1000000).toFixed(3)


            if (e.target.files && e.target.files[0]) {
                if (this.extensions.indexOf(ext) != -1) {
                    if (sizeMb < this.maxSize) {
                        var reader = new FileReader();

                        reader.onload = e => {
                            this.render(e.target.result)
                            this.callBack()
                        }

                        reader.readAsDataURL(e.target.files[0]);
                    } else {
                        alert('max-size: ' + this.maxSize + ' mb')
                    }
                } else {
                    alert('extensions only: ' + this.extensions)
                }
            }
        });
    }

    render(src) {
        this.preview.attr('href', src);
        this.preview.attr('style', "background-image: url('" + src + "'");
    }
}
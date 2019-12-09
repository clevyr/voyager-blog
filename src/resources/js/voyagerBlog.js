/*
* Voyager Blog Script
* */

class VoyagerBlog {
    constructor() {
        console.log('test');
    }

    getFields () {
        return document.querySelectorAll('.laraberg');
    }

    hasFields () {
        return fields && fields.length > 0;
    }
}

window.addEventListener('DomContentLoaded', () => {
    const VoyagerBlog = new VoyagerBlog();
});

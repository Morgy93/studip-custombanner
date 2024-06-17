class CustomBanner extends HTMLElement {
    connectedCallback() {
        console.debug('CustomBanner connected');
    }
}

customElements.define('custom-banner', CustomBanner);

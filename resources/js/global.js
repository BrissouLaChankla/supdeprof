





document.addEventListener('DOMContentLoaded', () => {

    const debounce = (callback, wait) => {
        let timeoutId = null;
        return (...args) => {
            window.clearTimeout(timeoutId);
            timeoutId = window.setTimeout(() => {
                callback.apply(null, args);
            }, wait);
        };
    }

    const switchMode = debounce(() => {


        if (localStorage.getItem("darkmode")) {
            
            document.documentElement.setAttribute('data-bs-theme', 'light');
            localStorage.removeItem("darkmode");
        } else {
            document.querySelector('.switch-label input').checked = true;
            document.documentElement.setAttribute('data-bs-theme', 'dark')
            localStorage.setItem("darkmode", "on");
        }

    }, 10);

    document.querySelector('.switch-label').addEventListener('click', switchMode);

})
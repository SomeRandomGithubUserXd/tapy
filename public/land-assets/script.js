(function () {
    const supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;

    if (supportsTouch) {
        return;
    }

    const links = document.querySelectorAll('.magnetic');

    const animateMe = function (e) {
        const span = this.querySelector('span');
        const {offsetX: x, offsetY: y} = e,
            {offsetWidth: width, offsetHeight: height} = this;

        move = 20;
        xMove = x / width * (move * 2) - move;
        yMove = y / height * (move * 2) - move;

        span.style.transform = `translate(${xMove}px, ${yMove}px)`;

        if (e.type === 'mouseleave') span.style.transform = '';
    };

    links.forEach(link => link.addEventListener('mousemove', animateMe));
    links.forEach(link => link.addEventListener('mouseleave', animateMe));
})();

(function () {
    const buttons = document.querySelectorAll('.intro-button-flip');
    const changeOrder = [1, 0, 2, 4, 3];
    let currentOrderIndex = 0;

    setInterval(() => {
        const index = changeOrder[currentOrderIndex];
        buttons[index].classList.toggle("next");
        currentOrderIndex++;
        if (currentOrderIndex > changeOrder.length - 1) {
            currentOrderIndex = 0;
        }
    }, 2000);
})();

(function () {
    var isInViewport = function (elem) {
        var distance = elem.getBoundingClientRect();

        var top = distance.top;
        var bottom = distance.bottom;
        var windowHeight = window.innerHeight || document.documentElement.clientHeight;

        var visibleTop = top > 0 && top < windowHeight;
        var visibleBottom = bottom > 0 && bottom < windowHeight;

        return (
            visibleTop || visibleBottom
        );
    };

    var nodes = document.querySelectorAll('.check-view');

    function cb() {
        nodes.forEach((element, index) => {
            if (!element.classList.contains("viewed") && isInViewport(element)) {
                element.classList.add("viewed");
            }
        });
    }
    cb();
    window.addEventListener('scroll', cb, false);

    let reverse = false;
    let i = 0;
    let txts = ['username', 'nick', 'yourbrand', 'your_name', 'elon.musk']
    let currentTxtIndex = 0;
    let txt = txts[currentTxtIndex];
    let speed = 70;

    function typeWriter() {
        const el = document.getElementById("page-link");

        if (!reverse) {
            el.innerText += txt.charAt(i);
            i++;

            if (i >= txt.length) {
                reverse = true;
                currentTxtIndex++;
                if (currentTxtIndex >= txts.length ) {
                    currentTxtIndex = 0
                }
                txt = txts[currentTxtIndex];

                setTimeout(typeWriter, speed * 30);
            } else {
                setTimeout(typeWriter, speed);
            }

        } else {
            el.innerText = el.innerText.substr(0, el.innerText.length - 1);
            i--;

            if (i <= 0) {
                reverse = false;

            }

            setTimeout(typeWriter, speed / 2);
        }
    }

    typeWriter()
})();

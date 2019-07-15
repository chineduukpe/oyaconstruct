console.log('Dev C Library Included.');


/*
 *	USING TOAST TO RETURN ERROR OR SUCCESS MESSAGE
 *	The callback is closeTopBar() to close the status bar when async request is done.
 */
const useToast = (type, title, message, timeout = 20000) => {
    //closeTopbar();//Close progressbar before reporting error
    switch (type) {
        case 'success':
            {
                return iziToast.success({
                    title,
                    message,
                    timeout,
                });
                break;
            }
        case 'warning':
            {
                return iziToast.warning({
                    title,
                    message,
                    timeout,
                })
                break;
            }
        case 'error':
            {
                return iziToast.error({
                    title,
                    message,
                    timeout,
                });
                break;
            }
    }
}


/**
 * RUN BASIC FETCH REQUEST POST
 * @param {*} url 
 * @param {*} method 
 * @param {*} data 
 */
const fr = (url, method = "GET", data = null) => {
    //topbar.show();					//Start progress bar before async request
    return fetch(url, {
        method: method.toUpperCase(),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),

        },
        body: JSON.stringify(data),
    });
};

// GET REQUEST
const fgr = (url, method = "GET", data = null) => {
    //topbar.show();					//Start progress bar before async request
    return fetch(url, {
        method: method.toUpperCase(),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),

        },
    });
};

/**
 * CHECK IS AN ELEMENT IS EMPTY OR NULL
 * @param {*}  field
 */
const isFieldEmpty = $field => {
    if ($field === '' || $field === null) {
        return true;
    }
    return false;
}

/*CLOSING TOPBAR ANIMATION*/
const closeTopbar = () => {
    // Check if Topbar library in included. Close the topbar, else call function that returns null
    return topbar.hide instanceof Function ? topbar.hide() : () => null;

}

/**
 * THROW A NETWORK ERROR USING TOAST
 * @param {*} subject
 */
const toastNetworkError = (subject) => {
    return useToast('error', subject, "A network error has occured. Please try again.");
}

/**
 * MATCH TWO ELEMENT
 * @param {*} subject1 
 * @param {*} subject2 
 */
const isExact = (subject1, subject2) => subject1 === subject2


/**
 * return a new select option
 * @param {*} value 
 * @param {*} text 
 * @param {*} classes 
 */
const newSelectOption = (value, text = null, classes = '') => (`<option value='${value}'> ${text ? text : value} </option>`)

/**
 * return a new select element
 * @param {*} name 
 * @param {*} classes 
 */
const newSelectElement = (name = '', classes = '') => (`<select name='${name}' class='${classes}'> </select>`)

/**
 *  return a new input element
 * @param {*} type 
 * @param {*} name 
 * @param {*} classes 
 */
const newInputElement = (type = 'text', name = '', classes = '') => `<input type='${type}' name='${name}' class='${classes}' `

/**
 * DISABLE FORMS
 */
const disableForms = (action = true) => {
    if (action) {
        return $('button[type=submit], input[type=submit], a[type=submit]').prop('disabled', true);
    }
    return $('button[type=submit], input[type=submit], a[type=submit]').prop('disabled', false);
}

const fetchImageInBase64 = (url, element) => {
    if (!url) {
        return null;
    }
    console.log(url)
    let options = {
        method: "GET",
        mode: 'cors',
        cache: 'default'
    }
    var imageStr = 'a';
    var base64Flag = 'b';

    let request = new Request(url);

    fetch(request, options)
        .then(response => {
            response.arrayBuffer().then(buffer => {
                base64Flag = 'data:image/jpeg;base64,';
                imageStr = arrayBufferToBase64(buffer);
                element.attr('src', base64Flag + imageStr)
                    // console.log(base64Flag + imageStr);  
            })
        })

    return base64Flag + imageStr
}

const arrayBufferToBase64 = buffer => {
    let binary = '';
    let bytes = [].slice.call(new Uint8Array(buffer))

    bytes.forEach((b) => binary += String.fromCharCode(b));

    return window.btoa(binary);
}

/*
 * MAGNIGYING GLASS
 * ON HOVER ON AN ELEMENT, IT GIVES A ZOOMED VIEW OF THE ELEMENT
 * TAKES TWO PARAMETERS
 * @param element id
 * @param zoom amount int
 * */
function magnify(imgID, zoom) {
    var img, glass, w, h, bw;
    img = document.getElementById(imgID);

    /* Create magnifier glass: */
    glass = document.createElement("DIV");
    glass.setAttribute("class", "img-magnifier-glass");

    /* Insert magnifier glass: */
    img.parentElement.insertBefore(glass, img);

    /* Set background properties for the magnifier glass: */
    glass.style.backgroundImage = "url('" + img.src + "')";
    glass.style.backgroundRepeat = "no-repeat";
    glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
    bw = 3;
    w = glass.offsetWidth / 2;
    h = glass.offsetHeight / 2;

    /* Execute a function when someone moves the magnifier glass over the image: */
    glass.addEventListener("mousemove", moveMagnifier);
    img.addEventListener("mousemove", moveMagnifier);

    /*and also for touch screens:*/
    glass.addEventListener("touchmove", moveMagnifier);
    img.addEventListener("touchmove", moveMagnifier);

    function moveMagnifier(e) {
        var pos, x, y;
        /* Prevent any other actions that may occur when moving over the image */
        e.preventDefault();
        /* Get the cursor's x and y positions: */
        pos = getCursorPos(e);
        x = pos.x;
        y = pos.y;
        /* Prevent the magnifier glass from being positioned outside the image: */
        if (x > img.width - (w / zoom)) { x = img.width - (w / zoom); }
        if (x < w / zoom) { x = w / zoom; }
        if (y > img.height - (h / zoom)) { y = img.height - (h / zoom); }
        if (y < h / zoom) { y = h / zoom; }
        /* Set the position of the magnifier glass: */
        glass.style.left = (x - w) + "px";
        glass.style.top = (y - h) + "px";
        /* Display what the magnifier glass "sees": */
        glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
    }

    function getCursorPos(e) {
        var a, x = 0,
            y = 0;
        e = e || window.event;
        /* Get the x and y positions of the image: */
        a = img.getBoundingClientRect();
        /* Calculate the cursor's x and y coordinates, relative to the image: */
        x = e.pageX - a.left;
        y = e.pageY - a.top;
        /* Consider any page scrolling: */
        x = x - window.pageXOffset;
        y = y - window.pageYOffset;
        return { x: x, y: y };
    }
}
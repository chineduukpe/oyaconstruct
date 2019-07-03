console.log('Dev C Library Included.');


	/*
	*	USING TOAST TO RETURN ERROR OR SUCCESS MESSAGE
	*	The callback is closeTopBar() to close the status bar when async request is done.
	*/
	const useToast = (type,title,message,timeout = 20000) =>{
		//closeTopbar();//Close progressbar before reporting error
		switch(type){
			case 'success':{
				return iziToast.success({
					title,
					message,
					timeout,
				});
				break;
			}
			case 'warning' :{
				return iziToast.warning({
					title,
					message, 
					timeout,
				})
				break;
			}
			case 'error' :{
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
	const  fr =(url, method = "GET",data = null) => {
		//topbar.show();					//Start progress bar before async request
		return fetch(url,{
		 	method: method.toUpperCase(),
		 	headers: {
                'Content-Type' : 'application/json',
                'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content'),

		 	},
		 	body: JSON.stringify(data),
		 });
    };

    // GET REQUEST
    const  fgr =(url, method = "GET",data = null) => {
		//topbar.show();					//Start progress bar before async request
		return fetch(url,{
		 	method: method.toUpperCase(),
		 	headers: {
                'Content-Type' : 'application/json',
                'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content'),

		 	},
		 });
    };
    
    /**
     * CHECK IS AN ELEMENT IS EMPTY OR NULL
     * @param {*}  field
     */
	const  isFieldEmpty = $field => {
		if ($field === '' || $field === null) {
			return true;
		}
		return false;
	}
	
	/*CLOSING TOPBAR ANIMATION*/
	const closeTopbar = () =>{
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
	const  isExact = (subject1, subject2) => subject1 === subject2
    

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
    const newSelectElement = (name ='', classes = '' ) => (`<select name='${name}' class='${classes}'> </select>`)

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
               return $('button[type=submit], input[type=submit], a[type=submit]').prop('disabled',true);
        }
        return $('button[type=submit], input[type=submit], a[type=submit]').prop('disabled',false);
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
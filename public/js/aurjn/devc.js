$(document).ready(() => {
    'use strict';
    console.log('APP STARTED')
        // $('select').selectpicker();

    /**
     * PAGE LEVEL SCRIPTS
     * VENDOR PRODUCTS PAGE
     */
    $('a[href="#vendorProductDetail"]').click(function(e) {
        /*
         * GET THE ID OF THE CLICKED ITEM
         */
        let id = $(this).attr('product-id');
        let url = $('#productViewURLContainer').attr('data-location') + '/' + id;
        $('input[name=producttoupdate]').val(id);
        $('input[name=amount]').val('');
        let method = "GET";

        /**
         * RUN FETCH ASYNC REQUEST TO GET RECORD FOR THE CLICKED ITEM
         */
        fgr(url, method)
            .then(res => {
                // console.log(res);
                return res.json();
            })
            .then(data => {
                if (data.error) {
                    useToast('error', 'PRODUCT UPDATE', data.message);
                    return;
                }
                $('.productDescriptionLabel').html(data.productname);

                return;
            })
            .catch(err => {
                console.log("SOMETHING WENT WRONG DURING FETCH PRODUCT REQUEST.");
            })
    });


    /**
     * SUBMIT UPDATE FOR QUANTITY
     */
    $('#vendorUpdateQuantity').submit(function(e) {
        e.preventDefault()
        let $this = $(this);
        let method = $this.attr('method');
        let url = $this.attr('action');
        let product = $this.find('input[name=producttoupdate]').val();
        let amount = $this.find('input[name=amount]').val();
        if (isFieldEmpty(amount)) {
            useToast('warning', "Quantity", 'Quantity Cannot be empty');
            return;
        }

        /**
         * Disable forms to prevent submitting multiple times
         */
        disableForms()

        fr(url, method, { product, amount })
            .then(res => res.json())
            .then((data) => {
                if (data.error) {
                    useToast('error', 'Quantity', data.error, 5000);
                    return disableForms(false);
                }
                /**
                 * UPDATE THE DATATABLE WITH NEW VALUE
                 */
                // $(`tr[product-id=${product}]`).find('td.quantity').html(data.quantity)
                $(`a[product-id=${product}]`).find('i').html(data.quantity)
                useToast('success', 'Quantity', data.message);
                return disableForms(false); //Enable forms
            }).catch(error => {
                disableForms(false);
                return toastNetworkError("Quantity");
            })
    });

    /**
     * PAGE LEVEL SCRIPTS
     * ADMIN COLOURS PAGE
     * Hold Currently Clicked Item to delete
     */
    $('a[href="#deleteColourModal"]').click(function(e) {
        let $this = $(this);
        let colour_id = $this.attr('colour-id');
        $('#confirmDeleteColour').attr('colour-id', colour_id);
    });
    //Confirm delete colour
    $('a#confirmDeleteColour').click(function(e) {
        let $this = $(this);
        let id = $this.attr('colour-id');
        let url = $this.attr('href');
        // let url = $this.attr('href') + "/" + id;
        let _token = $('input[name=_token]').val()
        console.log(_token)

        fr(url, 'POST', { _token, id })
            .then(res => {
                console.log(res)
                return res.json()
            })
            .then(data => {
                if (data.error) {
                    return useToast('error', 'COLOUR: ', data.error);
                }

                $(`li[colour-id=${id}]`).remove();
                return useToast('success', 'COLOUR', data.message);
            })
            .catch(err => {
                return toastNetworkError('COLOUR')
            });
    });

    $('#addColourForm').submit(function(e) {
        e.preventDefault()
        let $this = $(this);
        let url = $this.attr('action');
        let method = $this.attr('method');
        let _token = $('input[name=_token]').val()
        let colour = $this.find('input[name=colour]').val();

        // Prevent submission when colour field is empty
        if (isFieldEmpty(colour))
            return;
        disableForms()
        fr(url, method.toUpperCase(), { colour, _token })
            .then(res => res.json())
            .then(data => {
                disableForms(false)
                if (data.error) {
                    return useToast('error', "COLOUR: ", data.error);
                }
                3

                $(`
                <li class="list-group-item col-sm-8" colour-id="${data.colour_id}">
                ${colour}
                <a href="#colorDetail" style="background-color: ${data.colour}; color: #fff" colour-id="${data.colour_id}" data-toggle='modal'
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    
                </a>
                <a href="#editColourModal" color-id="${data.colour_id}" data-toggle="modal"> <span class="fas fa-edit"></span></a>
                <a href="#deleteColourModal" colour-id="${data.colour_id}" data-toggle="modal"><span class="fas fa-trash"></span></a>
                </li>
                `).insertAfter('ul.colour-table li:nth-child(1)')
                return useToast('success', 'COLOUR: ', data.message);
            })
            .catch(err => {
                disableForms(false)
                return toastNetworkError("COLOUR");
            });
    })

    $('a[href="#editColourModal"]').click(function(e) {
        let id = e.currentTarget.getAttribute('colour-id')
        let colour = $(`li[colour-id=${id}]`).find(`.colour-name`).attr('id');
        $('#editColourForm').find('input[name=colour]').val(colour);
        console.log(id)
        $('#editColourForm').attr('colour-id', id);
    });

    $('#editColourForm').submit(function(e) {
        e.preventDefault();
        let $this = $(this)
        let id = $this.attr('colour-id');
        let colour = $this.find('input[name=colour]').val();
        let method = $this.attr('method');
        let url = $this.attr('action');
        let _token = $('input[name=_token]').val()

        if (isFieldEmpty(colour))
            return;

        disableForms();
        fr(url, method.toUpperCase(), { colour, _token, id })
            .then(res => {
                console.log(res)
                return res.json();
            })
            .then(data => {
                disableForms(false)
                if (data.error) {
                    return useToast('error', 'Colour: ', data.error)
                }
                $(`li[colour-id=${id}]`).find('span.colour-name').html(colour);
                $(`li[colour-id=${id}]`).find('a[href="#colorDetail"]').style('background-colour', colour);
                return useToast('success', 'Colour', data.message)
            })
            .catch(e => {
                disableForms(false)
                return toastNetworkError("COLOUR: ")
            })

    });

    /**
     * PAGE LEVEL SCRIPTS
     * ADMIN SIZE PAGE
     * Hold Currently Clicked Item to delete
     */
    $('a[href="#deleteSizeModal"]').click(function(e) {
        let $this = $(this);
        let size_id = $this.attr('size-id');
        $('#confirmDeleteSize').attr('size-id', size_id);
    });
    //Confirm delete colour
    $('a#confirmDeleteSize').click(function(e) {
        let $this = $(this);
        let id = $this.attr('size-id');
        let url = $this.attr('href');
        // let url = $this.attr('href') + "/" + id;
        let _token = $('input[name=_token]').val()
        console.log(_token)

        fr(url, 'POST', { _token, id })
            .then(res => {
                console.log(res)
                return res.json()
            })
            .then(data => {
                if (data.error) {
                    return useToast('error', 'COLOUR: ', data.error);
                }

                $(`li[size-id=${id}]`).remove();
                return useToast('success', 'COLOUR', data.message);
            })
            .catch(err => {
                return toastNetworkError('COLOUR')
            });
    });

    $('#addSizeForm').submit(function(e) {
        e.preventDefault()
        let $this = $(this);
        let url = $this.attr('action');
        let method = $this.attr('method');
        let _token = $('input[name=_token]').val()
        let size = $this.find('input[name=size]').val();

        // Prevent submission when colour field is empty
        if (isFieldEmpty(size))
            return;
        disableForms()
        fr(url, method.toUpperCase(), { size, _token })
            .then(res => {
                console.log(res)
                return res.json()
            })
            .then(data => {
                disableForms(false)
                if (data.error) {
                    return useToast('error', "Size: ", data.error);
                }
                3

                $(`
                <li class="list-group-item col-sm-8" size-id="${data.size_id}">
                ${size}
                <a href="sizeDetail" style="background-color: ${data.size}; color: #fff" colour-id="${data.size_id}" data-toggle='modal'
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    
                </a>
                <a href="#editSizeModal"size-id="${data.size_id}" data-toggle="modal"> <span class="fas fa-edit"></span></a>
                <a href="#deleteSizeModal" size-id="${data.size_id}" data-toggle="modal"><span class="fas fa-trash"></span></a>
                </li>
                `).insertAfter('ul.size-table li:nth-child(1)')
                return useToast('success', 'Size: ', data.message);
            })
            .catch(err => {
                disableForms(false)
                return toastNetworkError("Size");
            });
    })

    $('a[href="#editSizeModal"]').click(function(e) {
        let id = e.currentTarget.getAttribute('size-id')
        let size = $(`li[size-id=${id}]`).find(`.size-name`).attr('id');
        $('#editSizeForm').find('input[name=size]').val(size);
        console.log(id)
        $('#editSizeForm').attr('Size-id', id);
    });

    $('#editSizeForm').submit(function(e) {
        e.preventDefault();
        let $this = $(this)
        let id = $this.attr('size-id');
        let size = $this.find('input[name=size]').val();
        let method = $this.attr('method');
        let url = $this.attr('action');
        let _token = $('input[name=_token]').val()

        if (isFieldEmpty(size))
            return;

        disableForms();
        fr(url, method.toUpperCase(), { size, _token, id })
            .then(res => {
                console.log(res)
                return res.json();
            })
            .then(data => {
                disableForms(false)
                if (data.error) {
                    return useToast('error', 'Size: ', data.error)
                }
                $(`li[size-id=${id}]`).find('span.size-name').html(size);
                return useToast('success', 'Size', data.message)
            })
            .catch(e => {
                disableForms(false)
                return toastNetworkError("Size: ")
            })

    });

    /**
     * PAGE LEVEL SCRIPT
     * ADMIN ADD PRODUCT PAGE.
     */
    //ADD A NEW FILE INPUT FIELD WHEN THE ADD BUTTON IS CLICKED
    $('#moreAltPhoto').click(function(e) {
        $('.alternate-photos').append(`
        <div class="form-group">
              <label class="control-label" for="name">Alternate Photos</label>
              <input type="file" id="pic" name="altpic[]" placeholder="pic" class="form-control">
            </div>
        `);
    });

    // ADD A NEW PRICE AND SIZE TO A PRODUCT
    $('#addProductPriceForm').submit(function(e) {
        e.preventDefault();
        let $this = $(this);
        let price = $this.find('input[name="price"]');
        let product = $this.find('input[name="productid"]');
        let size = $this.find('select[name="size"]').val();
        let url = $this.attr('action');
        let method = $this.attr('method').toUpperCase();

        if (isFieldEmpty(price) || price < 1) {
            return useToast('error', 'PRICE', 'You have entered an invalid price.');
        }

        console.log({
            product_id: product.val(),
            price: price.val(),
            size_id: size,
        })
        disableForms();

        fr(url, method, {
                product_id: parseInt(product.val()),
                price: parseFloat(price.val()),
                size_id: parseInt(size),
            })
            .then(res => {
                console.log(res);
                return res.json();
            })
            .then(data => {
                disableForms(false)
                console.log(data)
                if (data.error) {
                    alert(data.error)
                    return useToast('error', 'Size: ', data.error)
                }
                price.val('');
                alert(data.message)
                return useToast('success', 'PRICE', 'Price has been successfully attached to the product');
            })
            .catch(err => {
                disableForms(false);
                return useToast('error', 'PRICE: ', 'A network error has occured. Please try again.');
            })

    });

    //DELETEING A PRODUCT
    $('i .delete-product').click(function(e) {
        let $this = $(this);
        let id = $this.attr('id');
        console.log(id);
    });

    $('#confirmDeleteProduct').click(function(e) {
        let id = $(this).attr('product-id');
        let url = $('#deleteProductModal').attr('action') + '/' + parseInt(id);
        console.log(url);

        fgr(url, "GET")
            .then(res => {
                console.log(res);
                return res.json();
            })
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return useToast('error', 'PRODUCT', data.error);
                }
                console.log(data);
                $('#product-parent' + id).remove()
                alert(data.message);
                return useToast('success', 'PRODUCT', data.message);
            })
            .catch(e => {
                alert('A network error occured');
                return useToast('error', 'PRODUCT: ', 'A network error occured');
            });
    });


    /*
     * PAGE LEVEL SCRIPT
     * VIEW PRODUCT ON MARKET
     * */
    let product_to_cart = {};
    $('.product-alt-photo').click(function(e) {
        let url = $(this).attr('src');

        $('.product-alt-photo').removeClass('active');
        e.currentTarget.classList.add('active');

        let main_photo = $('#productMainPhoto');
        fetchImageInBase64(url, main_photo);
    });

    $('input[name="product-colour"]').click(function(e) {
        $('.product-purchase-colour').removeClass('active');
        $(this).parent().addClass('active');
        product_to_cart.colour = parseInt($(this).val());
        product_to_cart.product_id = parseInt($('#addToCartForm').find('input[name=productid]').attr('value'));
        console.log(product_to_cart)
    });

    $('#addToCartForm').find('input[name=size]').click(function(e) {
        product_to_cart.size = parseInt($(this).attr('value'));
    });
    $('#addToCartForm').find('input[name="quantity"]').change(function(e) {
        parseInt($(this).val()) < 1 ? $(this).val(1) : '';
        product_to_cart.quantity = parseInt($(this).val())
        console.log(product_to_cart)
    });


    $('button#addToCartButton').click(function(e) {
        e.preventDefault();
        if (!product_to_cart.product_id) {
            product_to_cart.product_id = parseInt($('#addToCartForm').find('input[name=productid]').attr('value'));
        }
        //When the user clicks on add to cart without selecting a colour or size
        if (!product_to_cart.quantity) {
            product_to_cart.quantity = 1;
        }

        if ($('input[name="size"]')[0] && !product_to_cart.size) {
            return alertify
                .alert('Missing Data: ', "Please select a product size.");
        }

        if ($('input[name="product-colour"]')[0] && !product_to_cart.colour) {
            return alertify
                .alert('Missing Data: ', "Please select a product colour.");
        }

        product_to_cart.userid = parseInt($('meta[name="userid"]').attr('content'));
        product_to_cart.session = $('meta[name="session"]').attr('content');
        console.log(product_to_cart)
        fr('/api/cart/product/add', "POST", product_to_cart)
            .then(res => {
                console.log(res);

                return res.json();
            })
            .then(data => {
                if (data.error) {
                    alertify
                        .alert('Add Product To Cart', data.error);
                }
                alertify
                    .alert('Add Product To Cart', data.message);
            });
    });


    /**
     * PAGE LEVEL SCRIPT 
     * VIEW CART
     */




    /**
     * BEGIN PAYSTACK INTEGRATION
     */
    function payWithPaystack0001() {
        var loanid = $("#mloanid").val();
        var paymenttype = document.getElementById('paytype').value;
        var fname = document.getElementById('paystackfname').value;
        var lname = document.getElementById('paystacklname').value;

        let userid = $('input[name="paystackuserid"]').val();

        fr('/api/cart/verifypaymentamount', "POST", { userid })
            .then(res => {
                return res.json();
            })
            .then(data => {
                if (data.error) {
                    return alert('error occured');
                }
                if (!data.amount) {
                    return alert('Could not resolve the order amount');
                }

                var handler = PaystackPop.setup({
                    key: 'pk_live_5bc82598e87e6d7901b08a5aac99fdfc79fb0151', //public key, dont worry about this
                    email: 'contact@figi.ng', //this should be users email, but replace it with a figi email

                    amount: data.amount * 100, //amount is in kobo, so NGN * 100
                    currency: "NGN",
                    ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a reference code. 
                    //last paid generated ref by me: 716169799, save the code and remove this line.
                    firstname: fname,
                    lastname: lname,
                    metadata: {
                        custom_fields: [{
                            display_name: fname + " " + lname,
                            variable_name: "mobile_number", //no need to specify this field
                            value: document.getElementById('paystackphone').value //user mobile number should be here
                        }]
                    },
                    callback: function(response) {
                        //alert('success. transaction ref is ' + response.reference);
                        window.location = "{{URL::to('paystackpayment')}}?reference=" + response.reference + "&paymenttype=" + paymenttype + "&username=" + userid;
                    },
                    onClose: function() {;
                    }
                });
                handler.openIframe();
            });

    };
    /**
     * END PAYSTACK PAYMENT
     */


});
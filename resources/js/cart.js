const cart = document.getElementById('cartModal');
const addToCartBtn = document.querySelectorAll('.add_to_cart');

let cart_ids_js_stored = JSON.parse(localStorage.getItem("cart_ids_js_stored"));
const cartProductsList = document.querySelector('#modal-body');
const cartIsEmpty = document.querySelector('#cart-is_empty');

const fullPrice = cart.querySelector('.fullprice');
const cartQuantity = cart.querySelector('.cart-quantity');
let price = 0;

const generateCartProduct = (img, title, priceNumber, band, id) => {
    return `
		 <div class="cart-item" id="${id}">
		 <div class="cart-item-group">
		    <img src="${img}" alt="album-cover" class="cart-item-img">
            <!-- /.cart-item-img -->
            <div class="cart-item-info">
            <div class="cart-item-info-product">
                <p class="cart-item-name">${title}</p>
                <!-- /.cart-item-name -->
                <p class="cart-item-desc">${band}</p>
                <!-- /.cart-item-name -->
            </div>
            <!-- /.cart-item-info-product -->

                <span class="cart-product__price">${priceNumber} ₽</span>
            </div>
            <!-- /.cart-item-info -->
         </div>
		 <!-- /.cart-item-group -->

            <button class="cart-item-delete">Убрать &times;</button>
            <!-- /.cart-item-delete -->
         </div>
         <!-- /.cart-item -->
	`;
}
const checkLocalStorage = () => {
    if (typeof cart_ids_js_stored !== 'undefined' && cart_ids_js_stored !== null && cart_ids_js_stored.length > 0) {
        for (let subArr of cart_ids_js_stored){

            let img = subArr[0];
            let title = subArr[1];
            let priceNumber = subArr[2];
            let band = subArr[3];
            let id = subArr[4];
            console.log(subArr, img, title, priceNumber, band, id);
            cartUpdater(img, title, priceNumber, band, id);
            unEmptyCart();
        }
    }else {
        printFullPrice();
        printQuantity();
        cart_ids_js_stored = [];
    }
        // localStorage.removeItem('cart_ids_js_stored');
        // localStorage.setItem('cart_ids_js_stored', JSON.stringify(cart_ids_js));
}
const cartUpdater = (img, title, priceNumber, band, id) => {
    cartProductsList.insertAdjacentHTML('afterbegin', generateCartProduct(img, title, priceNumber, band, id));
    plusFullPrice(priceNumber);
    printFullPrice();
    printQuantity()
}
addToCartBtn.forEach(el =>{
el.addEventListener('click', e => {
    let self = e.currentTarget;
    let parent = self.closest('.product-container');
    let id = parent.id;
    let title = parent.querySelector('.product-title').textContent;
    let img = parent.querySelector('.product-img').getAttribute('src');
    let band = parent.querySelector('.product-author').textContent;
    let priceNumber = parseInt(parent.querySelector('.standart-card-price-new').textContent);

    let cartItemArr = [img, title, priceNumber, band, id];
    cart_ids_js_stored.push(cartItemArr)

    localStorage.setItem('cart_ids_js_stored', JSON.stringify(cart_ids_js_stored));
    cartUpdater(img, title, priceNumber, band, id);
    unEmptyCart();


    // function toggleArray(array, value) {
    //     let index = array.indexOf(+value);
    //
    //     if (index === -1) {
    //         array.push(+value);
    //         // localStorage.setItem('cart_ids_js_stored', JSON.stringify(cart_ids_js));
    //     } else {
    //         array.splice(index, 1);
    //         // localStorage.removeItem('cart_ids_js_stored');
    //         // localStorage.setItem('cart_ids_js_stored', JSON.stringify(cart_ids_js));
    //     }
    //     return array
    // }
    //
    // console.log(id,toggleArray(cart_ids_js, id), cart_ids_js);
    // console.log(JSON.parse(localStorage.getItem("cart_ids_js_stored")));
})
    }
)
const plusFullPrice = (currentPrice) => {
    return price += currentPrice;
};

const minusFullPrice = (currentPrice) => {
    return price -= currentPrice;
};

const printQuantity = () => {
    let productsListLength = cartProductsList.children.length;
    cartQuantity.textContent = productsListLength + ' шт.';
    productsListLength > 0 ? cart.classList.add('active') : cart.classList.remove('active');
};

const printFullPrice = () => {
    fullPrice.textContent = `${price} ₽`;
};

const emptyCart = () => {
    cartIsEmpty.classList.remove('d-none');
    cartProductsList.classList.add('d-none');
}
const unEmptyCart = () => {
    cartIsEmpty.classList.add('d-none');
    cartProductsList.classList.remove('d-none');
}
const deleteProducts = (productParent) => {
    let id = productParent.id;
    let cart_ids_js_stored = JSON.parse(localStorage.getItem("cart_ids_js_stored"));

    for (let x=0; x<cart_ids_js_stored.length; x++){
        console.log(id, cart_ids_js_stored[x]);
        if (cart_ids_js_stored[x][4] === id) {
            cart_ids_js_stored.splice(x, 1)
            localStorage.setItem('cart_ids_js_stored', JSON.stringify(cart_ids_js_stored));
        }
    }
    if (cart_ids_js_stored.length === 0) {
        emptyCart();
    }
    let currentPrice = parseInt(productParent.querySelector('.cart-product__price').textContent);
    minusFullPrice(currentPrice);
    printFullPrice();
    productParent.remove();

    printQuantity();
};
cartProductsList.addEventListener('click', (e) => {
    if (e.target.classList.contains('cart-item-delete')) {
        deleteProducts(e.target.closest('.cart-item'));
    }
});

checkLocalStorage();

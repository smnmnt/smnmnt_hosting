const cart = document.getElementById('cartModal');
const productAddToCartBtn = document.querySelectorAll('.product-add_to_cart');
const collectionAddToCartBtn = document.querySelectorAll('.collection-add_to_cart');

let cart_ids_js_stored = JSON.parse(localStorage.getItem("cart_ids_js_stored"));
let coll_cart_ids_js_stored = JSON.parse(localStorage.getItem("coll_cart_ids_js_stored"));

const cartProductsList = document.querySelector('#modal-body');
const cartIsEmpty = document.querySelector('#cart-is_empty');

const fullPrice = cart.querySelector('.fullprice');
const cartQuantity = cart.querySelector('.cart-quantity');
let price = 0;

const generateCartProduct = (img, title, fullPriceNumber,priceNumber, band, id) => {
    // console.log(fullPriceNumber)
    if (fullPriceNumber === 0) {
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

                <div class="cart-item-price-box">
                    <span class="cart-product__price standart-card-price-new">${priceNumber} ₽</span>
                </div>
               </div>
               <!-- /.cart-item-info -->
            </div>
		    <!-- /.cart-item-group -->

            <button class="cart-item-delete-product cart-item-delete">Убрать &times;</button>
            <!-- /.cart-item-delete -->
         </div>
         <!-- /.cart-item -->
	`
    } else {
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

                <div class="cart-item-price-box">
                    <span class="cart-product__price__old standart-card-price-old">${fullPriceNumber} ₽</span>
                    <span class="cart-product__price standart-card-price-new">${priceNumber} ₽</span>
                </div>
               </div>
               <!-- /.cart-item-info -->
            </div>
		    <!-- /.cart-item-group -->

            <button class="cart-item-delete-product cart-item-delete">Убрать &times;</button>
            <!-- /.cart-item-delete -->
         </div>
         <!-- /.cart-item -->
	`
    }
}
const generateCartCollection = (img, title, fullPriceNumber, priceNumber, quantity, id) => {
    return `
		 <div class="cart-item" id="collection-${id}">
		 <div class="cart-item-group">
		    <img src="${img}" alt="album-cover" class="cart-item-img">
            <!-- /.cart-item-img -->
            <div class="cart-item-info">
                <div class="cart-item-info-product">
                    <p class="cart-item-name">${title}</p>
                    <p class="cart-item-quantity">${quantity} шт. в коллекции</p>
                    <!-- /.cart-item-name -->
                </div>
                <!-- /.cart-item-info-product -->
                <div class="cart-item-price-box">
                    <span class="cart-product__price__old standart-card-price-old">${fullPriceNumber} ₽</span>
                    <span class="cart-product__price standart-card-price-new">${priceNumber} ₽</span>
                </div>
            </div>
            <!-- /.cart-item-info -->
         </div>
		 <!-- /.cart-item-group -->

            <button class="cart-item-delete-collection cart-item-delete">Убрать &times;</button>
            <!-- /.cart-item-delete -->
         </div>
         <!-- /.cart-item -->
	`;
}
const productCheckLocalStorage = () => {
    if (typeof cart_ids_js_stored !== 'undefined' && cart_ids_js_stored !== null && cart_ids_js_stored.length > 0) {
        for (let subArr of cart_ids_js_stored){

            let img = subArr[0];
            let title = subArr[1];
            let fullPriceNumber =subArr[2];
            let priceNumber = subArr[3];
            let band = subArr[4];
            let id = subArr[5];
            // console.log(subArr, img, title, priceNumber, band, id);
            cartUpdater(img, title, fullPriceNumber,priceNumber, band, id);
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
const collectionCheckLocalStorage = () => {
    if (typeof coll_cart_ids_js_stored !== 'undefined' && coll_cart_ids_js_stored !== null && coll_cart_ids_js_stored.length > 0) {
        for (let subArr of coll_cart_ids_js_stored){
            let img = subArr[0];
            let title = subArr[1];
            let fullPriceNumber = subArr[2];
            let priceNumber = subArr[3];
            let quantity = subArr[4];
            let id = subArr[5];
            // console.log(subArr, img, title, fullPriceNumber, priceNumber, quantity, id);
            collCartUpdater(img, title, fullPriceNumber, priceNumber, quantity, id);
            unEmptyCart();
        }
    }else {
        printFullPrice();
        printQuantity();
        coll_cart_ids_js_stored = [];
    }
    // localStorage.removeItem('cart_ids_js_stored');
    // localStorage.setItem('cart_ids_js_stored', JSON.stringify(cart_ids_js));
}
const cartUpdater = (img, title, fullPriceNumber,priceNumber, band, id) => {
    cartProductsList.insertAdjacentHTML('afterbegin', generateCartProduct(img, title, fullPriceNumber,priceNumber, band, id));
    plusFullPrice(priceNumber);
    printFullPrice();
    printQuantity()
}
const collCartUpdater = (img, title, fullPriceNumber, priceNumber, quantity, id) => {
    cartProductsList.insertAdjacentHTML('afterbegin', generateCartCollection(img, title, fullPriceNumber, priceNumber, quantity, id));
    plusFullPrice(priceNumber);
    printFullPrice();
    printQuantity()
}
productAddToCartBtn.forEach(el =>{
        el.addEventListener('click', e => {
            let self = e.currentTarget;
            let parent = self.closest('.product-container');
            let id = +parent.id;
            let title = parent.querySelector('.product-title').textContent;
            let img = parent.querySelector('.product-img').getAttribute('src');
            let band = parent.querySelector('.product-author').textContent;
            let fullPriceNumber = parseInt(parent.querySelector('.standart-card-price').textContent);
            let priceNumber = parseInt(parent.querySelector('.standart-card-price-new').textContent);
            // console.log(fullPriceNumber === priceNumber)

            if (fullPriceNumber === priceNumber) {
                let fullPriceNumber = 0;
                let cartItemArr = [img, title, fullPriceNumber,priceNumber, band, id];
                // console.log('asd');
                cart_ids_js_stored.push(cartItemArr);
                // console.log(cart_ids_js_stored);
                localStorage.setItem('cart_ids_js_stored', JSON.stringify(cart_ids_js_stored));
                cartUpdater(img, title, fullPriceNumber,priceNumber, band, id);
                unEmptyCart();
            } else {
                let cartItemArr = [img, title, fullPriceNumber,priceNumber, band, id];
                // console.log('kakasd');
                cart_ids_js_stored.push(cartItemArr);
                // console.log(cart_ids_js_stored);
                localStorage.setItem('cart_ids_js_stored', JSON.stringify(cart_ids_js_stored));
                cartUpdater(img, title, fullPriceNumber,priceNumber, band, id);
                unEmptyCart();

            }


        })
    }
)
collectionAddToCartBtn.forEach(el =>{
        el.addEventListener('click', e => {
            // img, title, fullPriceNumber, priceNumber, quantity, id
            let self = e.currentTarget;
            let parent = self.closest('.collection-container');
            let child = document.querySelector('.catalogue-box-cards');
            let id = +parent.id;
            let title = parent.querySelector('.collection-title').textContent;
            // console.log(title, id, child, parent)
            let img = child.firstElementChild.querySelector('.standart-card-img').getAttribute('src');
            let quantity = child.querySelectorAll('.catalogue-card').length;
            let fullPriceNumber = parseInt(parent.querySelector('.standart-card-price-old').textContent);
            let priceNumber = parseInt(parent.querySelector('.standart-card-price-new').textContent);

            let cartItemArr = [img, title, fullPriceNumber, priceNumber, quantity, id];
            coll_cart_ids_js_stored.push(cartItemArr)

            localStorage.setItem('coll_cart_ids_js_stored', JSON.stringify(coll_cart_ids_js_stored));
            collCartUpdater(img, title, fullPriceNumber, priceNumber, quantity, id);
            unEmptyCart();
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
    let id = +productParent.id;
    let cart_ids_js_stored = JSON.parse(localStorage.getItem("cart_ids_js_stored"));

    for (let x=0; x<cart_ids_js_stored.length; x++){
        // console.log(id, cart_ids_js_stored[x]);
        if (cart_ids_js_stored[x][5] === id) {
            cart_ids_js_stored.splice(x, 1)
            localStorage.setItem('cart_ids_js_stored', JSON.stringify(cart_ids_js_stored));
        }
    }
    if (coll_cart_ids_js_stored.length === 0 && cart_ids_js_stored.length === 0) {
        emptyCart();
    }
    let currentPrice = parseInt(productParent.querySelector('.cart-product__price').textContent);
    minusFullPrice(currentPrice);
    printFullPrice();
    productParent.remove();

    printQuantity();
};
const deleteCollections = (collectionParent) => {
    let id = parseInt(collectionParent.id.match(/\d+/));
    let coll_cart_ids_js_stored = JSON.parse(localStorage.getItem("coll_cart_ids_js_stored"));

    for (let x=0; x<coll_cart_ids_js_stored.length; x++){
        // console.log(id, coll_cart_ids_js_stored[x]);
        if (coll_cart_ids_js_stored[x][5] === id) {
            coll_cart_ids_js_stored.splice(x, 1)
            localStorage.setItem('coll_cart_ids_js_stored', JSON.stringify(coll_cart_ids_js_stored));
        }
    }
    if (coll_cart_ids_js_stored.length === 0 && cart_ids_js_stored.length === 0) {
        emptyCart();
    }
    let currentPrice = parseInt(collectionParent.querySelector('.cart-product__price').textContent);
    minusFullPrice(currentPrice);
    printFullPrice();
    collectionParent.remove();

    printQuantity();
};
cartProductsList.addEventListener('click', (e) => {
    if (e.target.classList.contains('cart-item-delete-product')) {
        deleteProducts(e.target.closest('.cart-item'));
    } else if (e.target.classList.contains('cart-item-delete-collection')) {
        deleteCollections(e.target.closest('.cart-item'));
    }
});

productCheckLocalStorage();
collectionCheckLocalStorage();

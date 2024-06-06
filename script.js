// Header Scroll Color Change
let header = document.querySelector("header");

window.addEventListener("scroll", () => {
  header.classList.toggle("shadow", window.scrollY > 0);
});

// Menu
let menu = document.querySelector("#menu-icon");
let navbar = document.querySelector(".navbar");

document.querySelector("#search-icon").onclick = () => {
  search.classList.toggle("active");
};

menu.onclick = () => {
  menu.classList.toggle("bx-x");
  navbar.classList.toggle("active");
};

// Remove Menu On Scroll
window.onscroll = () => {
  menu.classList.remove("bx-x");
  navbar.classList.remove("active");
};

let user = document.querySelector('.userr');

document.querySelector('.user').onclick = () => {
  user.classList.toggle('active');
  search.classList.remove('active');
}

// Add to Cart Section
let iconCart = document.querySelector(".cart");
let closeCart = document.querySelector(".close");
let body = document.querySelector("body");
let listProductHTML = document.querySelector(".shop-container");
let listCartHTML = document.querySelector(".listCart");
let iconCartSpan = document.querySelector(".cart span");

let listProducts = [];
let carts = [];

iconCart.addEventListener("click", () => {
  body.classList.toggle("showCart");
});

closeCart.addEventListener("click", () => {
  body.classList.toggle("showCart");
});

document.addEventListener("DOMContentLoaded", () => {
  let checkOut = document.querySelector(".checkOut");
  if (checkOut) {
    checkOut.addEventListener("click", () => {
      window.location.href = "checkout.html";
    });
  }
  initApp();
});

const addDataToHTML = () => {
  listProductHTML.innerHTML = "";
  if (listProducts.length > 0) {
    listProducts.forEach((product) => {
      let newProduct = document.createElement("div");
      newProduct.classList.add("box");
      newProduct.dataset.id = product.id;
      newProduct.innerHTML = `
              <img src="${product.image}" alt="">
              <h2>${product.name}</h2>
              <span class="price">Rp ${product.price}</span>
              <button class="addCart"><i class='bx bxs-cart-add'></i></button>
            `;
      listProductHTML.appendChild(newProduct);
    });
  }
};

listProductHTML.addEventListener("click", (event) => {
  let positionClick = event.target;
  if (positionClick.classList.contains("addCart")) {
    let product_id = positionClick.parentElement.dataset.id;
    addToCart(product_id);
  }
});

const addToCart = (product_id) => {
  let positionThisProductInCart = carts.findIndex(
    (value) => value.product_id == product_id
  );
  if (carts.length <= 0) {
    carts = [
      {
        product_id: product_id,
        quantity: 1,
      },
    ];
  } else if (positionThisProductInCart < 0) {
    carts.push({
      product_id: product_id,
      quantity: 1,
    });
  } else {
    carts[positionThisProductInCart].quantity =
      carts[positionThisProductInCart].quantity + 1;
  }
  addDataToHTML();
  addCartToHTML();
  addCartToMemory();
};

const addCartToMemory = () => {
  localStorage.setItem("cart", JSON.stringify(carts));
};

// This Section function to handle checkbox changes 
const handleCheckboxChange = (product_id, checked) => {
  let productInCart = carts.find((cart) => cart.product_id == product_id);
  if (productInCart) {
    productInCart.selected = checked;
    addCartToMemory();
  }
};

listCartHTML.addEventListener("change", (event) => {
  if (event.target.type === "checkbox") {
    let product_id = event.target.parentElement.dataset.id;
    handleCheckboxChange(product_id, event.target.checked);
  }
});

// addCartToHTML function to include checkbox state
const addCartToHTML = () => {
  listCartHTML.innerHTML = "";
  let totalQuantity = 0;
  if (carts.length > 0) {
    carts.forEach((cart) => {
      totalQuantity += cart.quantity;
      let newCart = document.createElement("div");
      newCart.classList.add("item");
      newCart.dataset.id = cart.product_id;
      let positionProduct = listProducts.findIndex(
        (value) => value.id == cart.product_id
      );
      let info = listProducts[positionProduct];
      newCart.innerHTML = `
                <div class="image">
                    <img src="${info.image}" alt="">
                </div>
                <div class="name">
                    ${info.name}
                </div>
                <div class="totalPrice">
                    ${info.price * cart.quantity}
                </div>
                <div class="quantity">
                    <span class="minus"><</span>
                    <span>${cart.quantity}</span>
                    <span class="plus">></span>
                </div>
                <input type="checkbox" ${cart.selected ? "checked" : ""}>
              `;
      listCartHTML.appendChild(newCart);
    });
  }
  iconCartSpan.innerText = totalQuantity;
};

listCartHTML.addEventListener("click", (event) => {
  let positionClick = event.target;
  if (
    positionClick.classList.contains("minus") ||
    positionClick.classList.contains("plus")
  ) {
    let product_id = positionClick.parentElement.parentElement.dataset.id;
    let type = "minus";
    if (positionClick.classList.contains("plus")) {
      type = "plus";
    }
    changeQuantity(product_id, type);
  }
});

const changeQuantity = (product_id, type) => {
  let positionItemInCart = carts.findIndex(
    (value) => value.product_id == product_id
  );
  if (positionItemInCart >= 0) {
    switch (type) {
      case "plus":
        carts[positionItemInCart].quantity =
          carts[positionItemInCart].quantity + 1;
        break;

      default:
        let valueChange = carts[positionItemInCart].quantity - 1;
        if (valueChange > 0) {
          carts[positionItemInCart].quantity = valueChange;
        } else {
          carts.splice(positionItemInCart, 1);
        }
        break;
    }
  }
  addCartToMemory();
  addCartToHTML();
};

const initApp = () => {
  // Get data from json
  fetch("products.json")
    .then((response) => response.json())
    .then((data) => {
      listProducts = data;
      addDataToHTML();

      // Get cart from memory
      if (localStorage.getItem("cart")) {
        carts = JSON.parse(localStorage.getItem("cart"));
        addCartToHTML();
      }
    });
};

document.addEventListener("DOMContentLoaded", () => {
  const cartItemsContainer = document.querySelector(".listProduct");
  const totalPriceElement = document.getElementById("totalPrice");

  let carts = JSON.parse(localStorage.getItem("cart")) || [];
  let products = [];

  const fetchProducts = () => {
    return fetch("products.json")
      .then((response) => response.json())
      .then((data) => {
        products = data;
        renderCartItems();
      });
  };

  const renderCartItems = () => {
    cartItemsContainer.innerHTML = "";
    let totalPrice = 0;

    carts.forEach((cartItem) => {
      if (cartItem.selected) {
        const product = products.find((p) => p.id == cartItem.product_id);
        if (product) {
          const itemTotalPrice = product.price * cartItem.quantity;
          totalPrice += itemTotalPrice;
          cartItem.price = product.price;
          cartItem.totalPrice = itemTotalPrice;

          const cartItemElement = document.createElement("div");
          cartItemElement.classList.add("cart-item");
          cartItemElement.innerHTML = `
            <div class="image">
              <img src="${product.image}" alt="${product.name}">
            </div>
            <div class="details">
              <div class="name">${product.name}</div>
              <div class="quantity">Quantity: ${cartItem.quantity}</div>
              <div class="price">Rp ${itemTotalPrice}</div>
            </div>
          `;
          cartItemsContainer.appendChild(cartItemElement);
        }
      }
    });

    totalPriceElement.textContent = `Rp ${totalPrice.toFixed(2)}`;
    localStorage.setItem("total", JSON.stringify(totalPrice));
    localStorage.setItem("cart", JSON.stringify(carts));
  };

  fetchProducts();
});

// Form Validation
const checkoutButton = document.querySelector(".buttonCheckout");
checkoutButton.disabled = true;

const form = document.querySelector("#checkoutForm");

form.addEventListener("keyup", function () {
  for (let i = 0; i < form.elements.length; i++) {
    if (form.elements[i].value.length === 0) {
      checkoutButton.disabled = true;
      checkoutButton.classList.add("disabled");
      return;
    }
  }
  checkoutButton.disabled = false;
  checkoutButton.classList.remove("disabled");
});

checkoutButton.addEventListener("click", async function (e) {
  e.preventDefault();
  const cartItems = JSON.parse(localStorage.getItem("cart")) || [];
  const total = JSON.parse(localStorage.getItem("total")) || 0;

  const formData = {
    items: cartItems,
    total: total,
    name: document.getElementById("name").value,
    email: document.getElementById("email").value,
    address: document.getElementById("address").value,
    size: document.getElementById("size").value,
    phone: document.getElementById("phone").value,
  };

  const message = formatMessage(formData);
  window.open("http://wa.me/6285828617312?text=" + encodeURIComponent(message));
});

const formatMessage = (obj) => {
  let itemsText = "";
  obj.items.forEach((item) => {
    const itemTotalPrice = item.price * item.quantity;
    itemsText += `Product ID: ${item.product_id} (Quantity: ${
      item.quantity
    } x Rp ${itemTotalPrice.toFixed(2)}) \n`;
  });

  return `Data Customer
Nama: ${obj.name}
Email: ${obj.email}
Alamat: ${obj.address}
Size: ${obj.size}
No Hp: ${obj.phone}
Data Pesanan:
${itemsText}
TOTAL: Rp ${obj.total.toFixed(2)}
Terima Kasih Sudah Berkunjung di Odop Store.
  `;
};
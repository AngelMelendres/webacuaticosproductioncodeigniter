var apps = new Vue({
  el: "#appCarrito",
  data: {
    cart: [], // Array de objetos con los productos del carrito
  },
  computed: {
    total: function () {
      // Calcular el precio total del carrito sumando el precio de cada producto
      return this.cart
        .reduce(function (acc, product) {
          return acc + product.cantidad * product.precio;
        }, 0)
        .toFixed(2);
    },
  },
  methods: {
    removeFromCart: function (item) {
      var index = this.cart.indexOf(item);
      this.cart.splice(index, 1);
      // Actualizar los datos del carrito en el local storage
      localStorage.setItem("cart", JSON.stringify(this.cart));
    },
  },
  mounted: function () {
    // Obtener los datos del carrito desde el local storage
    var savedCart = localStorage.getItem("cart");
    if (savedCart) {
      this.cart = JSON.parse(savedCart);
    }
    const cartIcon = document.getElementById("cart-icon");
    const totalProducts = this.cart.length;
    cartIcon.setAttribute("data-notify", totalProducts);

    // Escuchar cambios en el LocalStorage
    window.addEventListener("storage", (event) => {
      if (event.key === "cart") {
        var savedCart = JSON.parse(event.newValue);
        this.cart = savedCart;
      }
    });
  },
});

$(".js-show-cart").on("click", function (event) {
  event.stopPropagation();
  $(".js-panel-cart").addClass("show-header-cart");
});

$(".js-hide-cart").on("click", function () {
  $(".js-panel-cart").removeClass("show-header-cart");
});

$(document).on("click", function (event) {
  if (
    !$(event.target).closest(".js-panel-cart").length &&
    !$(event.target).is("#cart-container") &&
    $(".js-panel-cart").hasClass("show-header-cart")
  ) {
    $(".js-panel-cart").removeClass("show-header-cart");
  }
});

<?php include 'header.php'; ?>


<div class="container py-5">
    <h2 class="text-center mb-4">Shopping Cart</h2>

    <div class="row">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <!-- Cart Items -->
            <div class="card cart-item mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="overflow-hidden">
                                <img src="./images/p1.webp" class="img-fluid product-img" alt="Product">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h5 class="card-title">Wireless Headphones</h5>
                            <p class="text-muted mb-0">Color: Black</p>
                            <p class="text-danger fw-bold mb-0">$59.99</p>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex flex-column align-items-center">
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-danger">-</button>
                                    <input type="number" class="form-control text-center" value="1" min="1">
                                    <button class="btn btn-outline-danger">+</button>
                                </div>
                                <button class="btn btn-outline-danger remove-btn btn-sm">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card cart-item mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="overflow-hidden">
                                <img src="./images/p2.jpg" class="img-fluid product-img" alt="Product">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h5 class="card-title">Smart Watch</h5>
                            <p class="text-muted mb-0">Color: Silver</p>
                            <p class="text-danger fw-bold mb-0">$74.99</p>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex flex-column align-items-center">
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-danger">-</button>
                                    <input type="number" class="form-control text-center" value="1" min="1">
                                    <button class="btn btn-outline-danger">+</button>
                                </div>
                                <button class="btn btn-outline-danger remove-btn btn-sm">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <span>$134.98</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Shipping</span>
                        <span>$5.00</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Tax</span>
                        <span>$13.50</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-4">
                        <strong>Total</strong>
                        <strong class="text-danger">$153.48</strong>
                    </div>

                    <a href="checkout.php"><button class="btn btn-outline-danger w-100 mb-3">Proceed to
                            Checkout</button></a>
                    <a href="all_products.php"><button class="btn btn-outline-danger w-100">Continue
                            Shopping</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<style>
#orderContainer {
    height: 300px;
    overflow-y: auto;
}

.order-details-container {
    background-color: white;
    border: 1px solid #dee2e6;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" class="form-control" id="productSearch" placeholder="Search for a product...">
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    <!-- Product rows will be added here -->
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="order-details-container bg-white p-3 rounded shadow-sm">
                <h2>Order Details</h2>
                <div id="orderContainer" class="border p-3 mb-3">
                    <p>No items in the cart.</p>
                </div>
                <div class="mt-3">
                    <h4>Total: &#8369;<span id="orderTotal">0.00</span></h4>
                </div>
                <button id="btnPrint" class="btn btn-success mt-3">Checkout</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
let orNumber = null;
const orderItems = {}; // Object to keep track of products and quantities

function generateORNumber() {
    return Math.floor(10000 + Math.random() * 90000);
}

function resetOrderDetails() {
    $('#orderContainer').html('<p>No items in the cart.</p>');
    $('#orderTotal').text('0.00');
    orNumber = null;
    Object.keys(orderItems).forEach(key => delete orderItems[key]);
}

function resetSearch() {
    $('#productSearch').val('');
    $('#productTable').empty();
}

function validateQuantity($input) {
    const enteredQuantity = parseInt($input.val());
    const maxStock = parseInt($input.attr('max'));
    
    if (enteredQuantity > maxStock) {
        Swal.fire({
            title: 'Exceeds Available Stock',
            text: `You can't set higher because only ${maxStock} items of this product are available`,
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(() => {
            $input.val(maxStock);  // Set to max available stock
            updateQuantityInput($input);  // Update input state
        });
    } else if (enteredQuantity < 1 || isNaN(enteredQuantity)) {
        updateQuantityInput($input);  // Reset to appropriate value
    }
}

function updateQuantityInput($input) {
    const max = parseInt($input.attr('max'));
    if (max === 0) {
        $input.val(0);
        $input.prop('disabled', true);
        $input.closest('tr').find('.add-to-cart').prop('disabled', true);
    } else {
        $input.val(1);
        $input.prop('disabled', false);
        $input.closest('tr').find('.add-to-cart').prop('disabled', false);
    }
}

$('#productSearch').on('input', function() {
    const query = $(this).val().trim();
    if (query === '') {
        $('#productTable').empty();
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'fetch_products.php',
        data: { query: query },
        dataType: 'json',
        success: function(products) {
            $('#productTable').empty();
            if (products.length > 0) {
                products.forEach(product => {
                    const currentStock = product.productStock - (orderItems[product.id] ? orderItems[product.id].quantity : 0);
                    const isOutOfStock = currentStock <= 0;
                    const row = `<tr data-product-id="${product.id}">
                        <td><img src="${product.imageUrl}" style="height:50px; width:50px;"></td>
                        <td>${product.productName}</td>
                        <td>&#8369;${parseFloat(product.productPrice).toFixed(2)}</td>
                        <td><input type="number" min="1" value="${isOutOfStock ? 0 : 1}" max="${currentStock}" class="form-control quantity" ${isOutOfStock ? 'disabled' : ''}></td>
                        <td><button class="btn btn-primary add-to-cart" ${isOutOfStock ? 'disabled' : ''}>Add to Cart</button></td>
                    </tr>`;
                    $('#productTable').append(row);
                });
            } else {
                $('#productTable').append('<tr><td colspan="5">No products found</td></tr>');
            }
        }
    });
});

$(document).ready(function() {
    $('#productTable').on('input change', '.quantity', function() {
        validateQuantity($(this));
    });
});

$(document).on('click', '.add-to-cart', function() {
    const row = $(this).closest('tr');
    const id = row.data('product-id');
    const name = row.find('td').eq(1).text();
    const price = parseFloat(row.find('td').eq(2).text().substring(1));
    const quantityInput = row.find('.quantity');
    const quantity = parseInt(quantityInput.val());
    const stock = parseInt(quantityInput.attr('max'));
    const total = price * quantity;

    if (quantity > stock) {
        Swal.fire({
            title: 'Not enough stock',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
    }

    if (!orNumber) {
        orNumber = generateORNumber();
        $('#orderContainer').prepend(`<h4>OR Number: ${orNumber}</h4>`);
    }

    if (orderItems[id]) {
        orderItems[id].quantity += quantity;
        orderItems[id].totalPrice += total;
    } else {
        orderItems[id] = {
            name: name,
            quantity: quantity,
            totalPrice: total,
            price: price
        };
    }

    // Update stock immediately
    const newStock = stock - quantity;
    quantityInput.attr('max', newStock);
    
    // Set quantity input to 0 if no stock left, otherwise to 1
    quantityInput.val(newStock === 0 ? 0 : 1);
    
    // Disable the add to cart button and quantity input if stock is 0
    if (newStock === 0) {
        $(this).prop('disabled', true);
        quantityInput.prop('disabled', true);
    }

    updateOrderDisplay();
});

$(document).on('click', '.cancel-item', function() {
    const id = $(this).data('product-id');
    const canceledQuantity = orderItems[id].quantity;

    delete orderItems[id];

    updateOrderDisplay();

    // Restore the stock
    const productRow = $(`#productTable tr[data-product-id="${id}"]`);
    const quantityInput = productRow.find('.quantity');
    const currentStock = parseInt(quantityInput.attr('max'));
    const newStock = currentStock + canceledQuantity;
    quantityInput.attr('max', newStock);
    quantityInput.val(1); // Always reset to 1 when canceling
    
    // Re-enable the add to cart button and quantity input
    productRow.find('.add-to-cart').prop('disabled', false);
    quantityInput.prop('disabled', false);

    if (Object.keys(orderItems).length === 0) {
        resetOrderDetails();
    }
});

function updateOrderDisplay() {
    $('#orderContainer').empty();
    if (orNumber) {
        $('#orderContainer').append(`<h4>OR Number: ${orNumber}</h4>`);
    }

    let currentTotal = 0;
    for (const [id, details] of Object.entries(orderItems)) {
        const orderRow = `
            <div class="order-item">
                <p>${details.name} x ${details.quantity} - &#8369;${details.totalPrice.toFixed(2)}
                <button class="btn btn-sm btn-danger cancel-item" data-product-id="${id}">Cancel</button></p>
            </div>`;
        $('#orderContainer').append(orderRow);
        currentTotal += details.totalPrice;
    }

    $('#orderTotal').text(currentTotal.toFixed(2));

    if (Object.keys(orderItems).length === 0) {
        $('#orderContainer').append('<p>No items in the cart.</p>');
    }
}

function generateReceipt() {
    let receiptContent = `
    <div style="font-family: 'Courier New', monospace; width: 300px; margin: 0 auto; text-align: center;">
        <h3>Order Receipt</h3>
        <p>OR Number: ${orNumber}</p>
        <hr>
        <h4>Order Details:</h4>
        <div style="text-align: left;">
    `;

    for (const details of Object.values(orderItems)) {
        receiptContent += `<p>${details.name} x ${details.quantity} - &#8369;${details.totalPrice.toFixed(2)}</p>`;
    }

    receiptContent += `
        </div>
        <hr>
        <p><strong>Total: &#8369;${$('#orderTotal').text()}</strong></p>
        <p>Thank you for your purchase!</p>
    </div>
    `;

    return receiptContent;
}

function printReceipt() {
    const iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    document.body.appendChild(iframe);

    iframe.contentDocument.write(`
    <html>
    <head>
        <title>Print Receipt</title>
        <style>
            body {
                margin: 0;
                padding: 0;
            }
            @media print {
                body {
                    width: 300px;
                    margin: 0 auto;
                }
            }
        </style>
    </head>
    <body>
        ${generateReceipt()}
    </body>
    </html>
    `);
    iframe.contentDocument.close();

    iframe.contentWindow.print();

    iframe.onload = function() {
        setTimeout(function() {
            document.body.removeChild(iframe);
        }, 100);
    };
}

$('#btnPrint').on('click', function() {
    if (Object.keys(orderItems).length === 0) {
        Swal.fire({
            title: 'Empty Cart',
            text: 'Add to cart first',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
    }

    const orderDetails = [];
    let productDetailsString = '';
    let totalPrice = 0;

    for (const [id, details] of Object.entries(orderItems)) {
        orderDetails.push({
            productName: details.name,
            quantity: details.quantity,
            price: details.totalPrice
        });
        productDetailsString += `${details.name}:${details.quantity}, `;
        totalPrice += details.totalPrice;
    }

    productDetailsString = productDetailsString.slice(0, -2);

    $.ajax({
        type: 'POST',
        url: 'insert_order.php',
        data: {
            orNumber: orNumber,
            productDetails: productDetailsString,
            totalPrice: totalPrice.toFixed(2)
        },
        success: function(response) {
            Swal.fire({
                title: 'Order Placed!',
                text: 'Checkout successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    printReceipt();
                    resetOrderDetails();
                    resetSearch();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
});
</script>

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

function generateORNumber() {
    return Math.floor(10000 + Math.random() * 90000);
}

function resetOrderDetails() {
    $('#orderContainer').html('<p>No items in the cart.</p>');
    $('#orderTotal').text('0.00');
    orNumber = null;
}

function resetSearch() {
    $('#productSearch').val('');
    $('#productTable').empty();
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
        data: {
            query: query
        },
        dataType: 'json',
        success: function(products) {
            $('#productTable').empty();
            if (products.length > 0) {
                products.forEach(product => {
                    const row = `<tr>
                      <td><img src="${product.imageUrl}" style="height:50px; width:50px;"></td>
                        <td>${product.productName}</td>
                        <td>&#8369;${parseFloat(product.productPrice).toFixed(2)}</td>
                        <td><input type="number" min="1" value="1" max="${product.productStock}" class="form-control quantity"></td>
                        <td><button class="btn btn-primary add-to-cart">Add to Cart</button></td>
                    </tr>`;
                    $('#productTable').append(row);
                });
            } else {
                $('#productTable').append('<tr><td colspan="4">No products found</td></tr>');
            }
        }
    });
});

$(document).on('click', '.add-to-cart', function() {
    const row = $(this).closest('tr');
    const name = row.find('td').eq(1).text();
    const price = parseFloat(row.find('td').eq(2).text().substring(1));
    const quantity = parseInt(row.find('.quantity').val());
    const total = price * quantity;

    if (!orNumber) {
        orNumber = generateORNumber();
        $('#orderContainer').prepend(`<h4>OR Number: ${orNumber}</h4>`);
    }

    const orderRow = `<p>${name} x ${quantity} - &#8369;${total.toFixed(2)}</p>`;
    $('#orderContainer').append(orderRow);

    const currentTotal = parseFloat($('#orderTotal').text());
    $('#orderTotal').text((currentTotal + total).toFixed(2));

    if ($('#orderContainer').find('p:contains("No items in the cart.")').length) {
        $('#orderContainer').find('p:contains("No items in the cart.")').remove();
    }
});

function generateReceipt() {
    let receiptContent = `
    <div style="font-family: 'Courier New', monospace; width: 300px; margin: 0 auto; text-align: center;">
        <h3>Order Receipt</h3>
        <p>OR Number: ${orNumber}</p>
        <hr>
        <h4>Order Details:</h4>
        <div style="text-align: left;">
    `;

    $('#orderContainer p').each(function() {
        receiptContent += `<p>${$(this).text()}</p>`;
    });

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

    if ($('#orderContainer').children().length <= 1 && $('#orderContainer').text().trim() ===
        'No items in the cart.') {
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

    $('#orderContainer p').each(function() {
        const text = $(this).text();
        const parts = text.split(' x ');
        if (parts.length === 2) {
            const [product, quantityAndPrice] = parts;
            const [quantity, price] = quantityAndPrice.split(' - ₱');
            const itemPrice = parseFloat(price);
            orderDetails.push({
                productName: product.trim(),
                quantity: parseInt(quantity),
                price: itemPrice
            });
            productDetailsString += `${product.trim()}:${quantity}, `;
            totalPrice += itemPrice;
        }
    });


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
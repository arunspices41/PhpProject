<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Menu Order</h2>

        <form action="{{ route('user.saveuserdetails') }}" method="POST">
            <!-- CSRF token for Laravel -->
            @csrf

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Menu</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" class="item-checkbox" name="items[tea][selected]"></td>
                        <td>Tea</td>
                        <td><input type="text" class="unit-price" name="items[tea][unitprice]" value="10" readonly></td>
                        <td>
                            <select class="form-select quantity" data-unitprice="10" name="items[tea][quantity]"
                                disabled>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </td>
                        <td class="price">0</td>
                        <input type="hidden" name="items[tea][price]" class="price-input" value="0">
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="item-checkbox" name="items[meals][selected]"></td>
                        <td>Meals</td>
                        <td><input type="text" class="unit-price" name="items[meals][unitprice]" value="35" readonly></td>
                        <td>
                            <select class="form-select quantity" data-unitprice="35" name="items[meals][quantity]"
                                disabled>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </td>
                        <td class="price">0</td>
                        <input type="hidden" name="items[meals][price]" class="price-input" value="0">
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success center">Submit Order</button>
            </div>

        </form>
    </div>

    <script>
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const quantities = document.querySelectorAll('.quantity');
        const prices = document.querySelectorAll('.price-input');
        const unitprices = document.querySelectorAll('.unit-price');
        console.log('prices');
        console.log(prices);

        checkboxes.forEach((checkbox, index) => {
            checkbox.addEventListener('change', function() {
                const qtySelect = quantities[index];
                const price = prices[index]
                const row = qtySelect.closest('tr');
                const priceCell = row.querySelector('.price');
                const unitPrice = parseFloat(qtySelect.dataset.unitprice);
                const priceinput = row.querySelector('.price-input');


                if (this.checked) {
                    qtySelect.disabled = false;
                    const total = unitPrice * qtySelect.value;
                    priceCell.textContent = total;
                    priceinput.value=total;
                 
                } else {
                    qtySelect.disabled = true;
                    priceCell.textContent = 0;
                    priceInput.value = 0;
                }
            });
        });

        quantities.forEach(select => {
            select.addEventListener('change', function() {
                const row = this.closest('tr');
                const checkbox = row.querySelector('.item-checkbox');
                const priceCell = row.querySelector('.price');
                 const priceinput = row.querySelector('.price-input');
                if (checkbox.checked) {
                    const unitPrice = parseFloat(this.dataset.unitprice);
                    const qty = parseInt(this.value);
                    priceCell.textContent = unitPrice * qty;
                     priceInput.value = unitPrice * qty;
                }
            });
        });
    </script>
</body>

</html>

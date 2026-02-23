<!-- resources/views/products/create.blade.php -->
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 30px;
    }

    h2 {
        text-align: center;
    }

    form {
        width: 400px;
        margin: 0 auto;
        border: 1px solid black;
        padding: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
        border: 1px solid black;
    }

    input[type="radio"],
    input[type="checkbox"] {
        margin-right: 5px;
    }

    button,
    a {
        text-decoration: none;
        color: black;
        border: 1px solid black;
        background: #f0f0f0;
        padding: 5px 10px;
        margin-top: 10px;
        display: inline-block;
    }

    button:hover,
    a:hover {
        background: #ddd;
    }
</style>

<form action="{{ route('user.products.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2>ADD NEW PRODUCT</h2>
    <label for="">Product name*</label>
    <input type="text" name="p_name" required>
    <br>
    <br>
    <!-- <label>Product imgs*</label>
    <input type="file" id="p_imgs" name="p_imgs" accept="image/*" multiple required> -->

    <!-- <label>Product imgs*</label>
    <input type="file" name="p_imgs[]" id="p_imgs" multiple>
    @error('p_imgs')
    <span class="text-danger">{{ $message }}</span>
    @enderror -->

    <!-- <label>Product Photos (Max 5):</label>
    <input type="file" name="photos[]" multiple accept="image/*"> -->

    <label>Product Photos* (Max 5):</label>
    <input type="file"
        name="photos[]"
        id="photos"
        multiple
        accept="image/*"
        required>

    @error('photos')
    <span class="text-danger"> {{ $message }}</span>
    @enderror
    @error('photos.*')
    <span class="text-danger"> {{ $message }}</span>
    @enderror


    <br><br>
    <label for="">Product description</label>
    <textarea type="text" name="p_desc"></textarea>
    <br>
    <br>
    <label for="">Select Product Category*</label>
    <select name="cat_id" id="" required>
        <option value="">Categories</option>
        <option value="1">Electronics</option>
        <option value="2">Beauty and personal care</option>
        <option value="3">Health and Wellness</option>
        <option value="4">Fashion</option>
        <option value="5">Household and Grocery</option>
        <option value="6">Other</option>
    </select>
    <br>
    <br>
    <label for="">Product price*</label>
    <!-- <input type="number" name="p_price" id="" required> -->
    <input type="number" id="p_price" name="p_price" required min="0" step="0.01">
    <br><br>
    <label for="">Product offer price</label>
    <!-- <input type="number" name="p_offerprice" id=""> -->
    <input type="number" id="p_offerprice" name="p_offerprice" required min="0" step="0.01">
    <p id="error-message"></p>

    <label for="">Product Stock*</label>
    <input type="number" name="p_stock" id="" required>
    <br>
    <br>
    <button type="submit" name="submit">Add Product</button>
</form>
<h2>Shopping List</h2>
<p>Manage your shopping list.</p>
<form method="POST" action="add_to_shopping_list.php">
    <input type="text" name="item" placeholder="Enter item" required>
    <button type="submit">Add Item</button>
</form>
<div class="shopping-list">
    <h3>Your Shopping List</h3>
    <ul>
        <!-- This is where you would dynamically display the shopping list -->
        <li>Item 1: Apples</li>
        <li>Item 2: Chicken Breast</li>
        <li>Item 3: Quinoa</li>
    </ul>
</div>
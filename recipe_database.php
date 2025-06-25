<h2>Recipe Database</h2>
<p>Search for healthy recipes.</p>
<form method="POST" action="search_recipes.php">
    <input type="text" name="recipe_name" placeholder="Enter recipe name" required>
    <button type="submit">Search</button>
</form>
<div class="recipe-results">
    <h3>Recipe Results</h3>
    <ul>
        <!-- This is where you would dynamically display the search results -->
        <li>Recipe 1: Healthy Salad</li>
        <li>Recipe 2: Quinoa Bowl</li>
        <li>Recipe 3: Grilled Vegetables</li>
    </ul>
</div>
<?php include 'top.php'; ?>
<main class="home madimi-one-regular">
  <h1>Rally Cat's Cupboard</h1>
  <h2 class="montserrat-regular">Food Items</h2>
  
  <!-- SEARCH BAR (optional) -->
  <section class="search">
    <input type="text" placeholder="Search...">
    <select id="filterCategory">
      <option value="">All Categories</option>
      <option value="Fruit">Fruit</option>
      <option value="Vegetable">Vegetable</option>
      <option value="Protein">Protein</option>
      <option value="Milk Allergy">Milk Allergy</option>
      <option value="Peanut Allergy">Peanut Allergy</option>
      <option value="Treenut Allergy">Treenut Allergy</option>
      <option value="Gluten Allergy">Gluten Allergy</option>
      <option value="Vegan">Vegan</option>
      <option value="Kosher">Kosher</option>
    </select>
  </section>
  
  <!-- Add New Food Item Form (only if logged in) -->
  <section>
  <?php if (isset($_SESSION['username'])) { ?>
    <h3>Add New Food Item</h3>
    <table>
        <form action="add_item.php" id="newItem" method="POST">
        <tr class="addData">
            <th colspan="7" class="spanTwoMobile">New Entry</th>
        </tr>
        <tr class="addData">
            <th>Food Type</th>
            <th>Quantity</th>
            <th>Expiration Date</th>
            <th>Allergies</th>
            <th>Dietary Considerations</th>
            <th>Image Path</th>
            <th>Description</th>
        </tr>
        <tr class="addData">
            <td>
            <input type="text" id="food_type" name="food_type" placeholder="e.g., Canned Beans" required>
            </td>
            <td>
            <input type="number" id="quantity" name="quantity" min="1" required>
            </td>
            <td>
            <input type="date" id="exp_date" name="exp_date" required>
            </td>
            <td>
            <select id="allergies" name="allergies" required>
                <option value="">Select Allergy</option>
                <option value="None">None</option>
                <option value="Milk">Milk</option>
                <option value="Peanuts">Peanuts</option>
                <option value="Treenuts">Treenuts</option>
                <option value="Gluten">Gluten</option>
            </select>
            </td>
            <td>
            <select id="dietary_considerations" name="dietary_considerations" required>
                <option value="">Select Dietary Option</option>
                <option value="None">None</option>
                <option value="Vegetarian">Vegetarian</option>
                <option value="Vegan">Vegan</option>
                <option value="Kosher">Kosher</option>
                <option value="Halal">Halal</option>
            </select>
            </td>
            <td>
            <input type="text" id="image_path" name="image_path" placeholder="Relative path (e.g., images/beans.jpg)" required>
            </td>
            <td>
            <textarea id="description" name="description" placeholder="Item description" required></textarea>
            </td>
        </tr>
        <tr class="addData">
            <td colspan="7" class="spanTwoMobile">
            <input type="submit" value="Add Item">
            </td>
        </tr>
        </form>
    </table>
    <?php } ?>
  </section>
  
  <!-- Grid of Item Cards -->
  <section class="grid-container">
    <?php
      $sql = 'SELECT * FROM items ORDER BY exp_date ASC';
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($items as $item) {
          // Pass entire item data via a data attribute (encoded as JSON)
          $itemData = htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8');
          echo '<div class="item-card" data-item=\'' . $itemData . '\'>';
          echo '<img src="' . htmlspecialchars($item['image_path']) . '" alt="' . htmlspecialchars($item['food_type']) . '">';
          echo '<h3>' . htmlspecialchars($item['food_type']) . '</h3>';
          echo '</div>';
      }
    ?>
  </section>
  
  <!-- Modal for Item Details -->
  <div id="itemModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <img id="modalImage" src="" alt="">
      <h2 id="modalName"></h2>
      <p id="modalDescription"></p>
      <ul id="modalDetails"></ul>
    </div>
  </div>
  
  <script>
    // Modal elements
    const modal = document.getElementById("itemModal");
    const modalImage = document.getElementById("modalImage");
    const modalName = document.getElementById("modalName");
    const modalDescription = document.getElementById("modalDescription");
    const modalDetails = document.getElementById("modalDetails");
  
    // Open modal on item card click
    document.querySelectorAll('.item-card').forEach(card => {
      card.addEventListener('click', () => {
        let item = JSON.parse(card.getAttribute('data-item'));
        modal.style.display = "block";
        modalImage.src = item.image_path;
        modalName.textContent = item.food_type;
        // If a description exists, show it; otherwise leave it blank
        modalDescription.textContent = item.description ? item.description : "";
        let detailsHTML = "";
        <?php if (isset($_SESSION['username'])) { ?>
          detailsHTML += `<li>Quantity: ${item.quantity}</li>`;
        <?php } ?>
        detailsHTML += `<li>Expiration Date: ${item.exp_date}</li>`;
        detailsHTML += `<li>Allergies: ${item.allergies}</li>`;
        detailsHTML += `<li>Dietary: ${item.dietary_considerations}</li>`;
        modalDetails.innerHTML = detailsHTML;
      });
    });
  
    // Close modal when the close button is clicked
    document.querySelector('.close').addEventListener('click', () => {
      modal.style.display = "none";
    });
  
    // Close modal when clicking outside the modal content
    window.addEventListener('click', event => {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    });
  </script>
</main>
<?php include 'footer.php'; ?>
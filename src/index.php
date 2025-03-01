<?php include 'top.php'; ?>
<main class="home madimi-one-regular">
  <h1>Rally Cat's Cupboard</h1>

  <!-- Add New Food Item Form (only if logged in) -->
  <h2 class="montserrat-regular">Add New Food Item</h2>
  <section class="new-entry-section">
  <?php if (isset($_SESSION['username'])) { ?>
    <form action="add_item.php" id="newItem" method="POST" class="new-entry-form">
      <h2>New Entry</h2>
      <div class="form-grid">
        <div class="form-group">
          <label for="food_type">Food Type</label>
          <input type="text" id="food_type" name="food_type" placeholder="e.g., Canned Beans" required>
        </div>
        <div class="form-group">
          <label for="quantity">Quantity</label>
          <input type="number" id="quantity" name="quantity" min="1" required>
        </div>
        <div class="form-group">
          <label for="exp_date">Expiration Date</label>
          <input type="date" id="exp_date" name="exp_date" required>
        </div>
        <div class="form-group">
          <label for="allergies">Allergies</label>
          <select id="allergies" name="allergies" required>
            <option value="">Select Allergy</option>
            <option value="None">None</option>
            <option value="Milk">Milk</option>
            <option value="Peanuts">Peanuts</option>
            <option value="Treenuts">Treenuts</option>
            <option value="Gluten">Gluten</option>
          </select>
        </div>
        <div class="form-group">
          <label for="dietary_considerations">Dietary Considerations</label>
          <select id="dietary_considerations" name="dietary_considerations" required>
            <option value="">Select Dietary Option</option>
            <option value="None">None</option>
            <option value="Vegetarian">Vegetarian</option>
            <option value="Vegan">Vegan</option>
            <option value="Kosher">Kosher</option>
            <option value="Halal">Halal</option>
          </select>
        </div>
        <div class="form-group">
          <label for="image_path">Image Path</label>
          <input type="text" id="image_path" name="image_path" placeholder="Relative path (e.g., images/beans.jpg)" required>
        </div>
        <div class="form-group form-group-full">
          <label for="description">Description</label>
          <textarea id="description" name="description" placeholder="Item description" required></textarea>
        </div>
      </div>
      <button type="submit" class="submit-btn">Add Item</button>
    </form>
  <?php } ?>
</section>


  <hr>
  
  <!-- SEARCH SECTION: Three Controls -->
  <h2 class="montserrat-regular">Food Items</h2>
  <section class="search">
    <input type="text" id="searchInput" placeholder="Search by food type...">
    <select id="allergyFilter">
      <option value="">No Allergies</option>
      <option value="Milk">Milk</option>
      <option value="Peanuts">Peanuts</option>
      <option value="Treenuts">Treenuts</option>
      <option value="Gluten">Gluten</option>
    </select>
    <select id="dietaryFilter">
      <option value="">No Dietary Options</option>
      <option value="Vegetarian">Vegetarian</option>
      <option value="Vegan">Vegan</option>
      <option value="Kosher">Kosher</option>
      <option value="Halal">Halal</option>
    </select>
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
        <div id="modalQuantityUpdate">
            <button id="addQuantityBtn">Add Quantity</button>
            <button id="removeQuantityBtn">Remove Quantity</button>
        </div>
    </div>
  </div>
  
  <script>
    // Combined search filtering function
    function filterItems() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const allergyFilter = document.getElementById('allergyFilter').value.toLowerCase();
      const dietaryFilter = document.getElementById('dietaryFilter').value.toLowerCase();
      
      document.querySelectorAll('.item-card').forEach(card => {
        let item = JSON.parse(card.getAttribute('data-item'));
        const foodType = item.food_type.toLowerCase();
        const itemAllergy = item.allergies.toLowerCase();
        const itemDietary = item.dietary_considerations.toLowerCase();
        
        // Check text search, allergy filter and dietary filter
        const matchesSearch = foodType.includes(searchTerm);
        const matchesAllergy = (allergyFilter === "" || allergyFilter === "all") || (itemAllergy === allergyFilter);
        const matchesDietary = (dietaryFilter === "" || dietaryFilter === "all") || (itemDietary === dietaryFilter);
        
        if (matchesSearch && matchesAllergy && matchesDietary) {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      });
    }
    
    // Add event listeners for all filters
    document.getElementById('searchInput').addEventListener('keyup', filterItems);
    document.getElementById('allergyFilter').addEventListener('change', filterItems);
    document.getElementById('dietaryFilter').addEventListener('change', filterItems);
    
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
            // Store the current item for later use in update calls.
            window.currentItem = item;
            
            modal.style.display = "block";
            modalImage.src = item.image_path;
            modalName.textContent = item.food_type;
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
    
    // Function to update quantity via AJAX
    function updateQuantity(itemId, delta) {
    fetch("update_quantity.php", {
        method: "POST",
        headers: {
        "Content-Type": "application/json"
        },
        body: JSON.stringify({ item_id: itemId, delta: delta })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
        // Update the global currentItem with the new quantity
        window.currentItem.quantity = data.new_quantity;
        // Optionally update the modal details to reflect the new quantity
        // (Assuming the quantity is the first list item in modalDetails)
        modalDetails.innerHTML = `<li>Quantity: ${data.new_quantity}</li>
            <li>Expiration Date: ${window.currentItem.exp_date}</li>
            <li>Allergies: ${window.currentItem.allergies}</li>
            <li>Dietary: ${window.currentItem.dietary_considerations}</li>`;
        } else {
        alert("Update failed: " + data.error);
        }
    })
    .catch(err => console.error("Error:", err));
    }

    // Add event listener for the "Add Quantity" button
    document.getElementById("addQuantityBtn").addEventListener("click", function() {
    let addQty = parseInt(prompt("Enter quantity to add:"));
    if (isNaN(addQty) || addQty <= 0) {
        alert("Please enter a valid number greater than zero.");
        return;
    }
    updateQuantity(window.currentItem.id, addQty);
    });

    // Add event listener for the "Remove Quantity" button
    document.getElementById("removeQuantityBtn").addEventListener("click", function() {
    let removeQty = parseInt(prompt("Enter quantity to remove:"));
    if (isNaN(removeQty) || removeQty <= 0) {
        alert("Please enter a valid number greater than zero.");
        return;
    }
    // Optionally check if removeQty exceeds the current quantity before calling updateQuantity
    if(removeQty > window.currentItem.quantity) {
        alert("Cannot remove more than available quantity.");
        return;
    }
    updateQuantity(window.currentItem.id, -removeQty);
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
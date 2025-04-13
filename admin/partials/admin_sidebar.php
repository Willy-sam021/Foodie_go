<nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <div>
              
            <select name="category" id='filter' class='form-select bg-dark text-light fw-bold' required>
              <option value="">Filter Search</option>
              <option value="products">Products</option>
              <option value="sellers">Vendor Name</option>
          </select>
            </div>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="admin.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_view_orders.php">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
              

              
              <li class="nav-item">
                <a class="nav-link" href="admin_view_buyers.php">
                  <span data-feather="users"></span>
                  view all Buyers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_view_sellers.php">
                  <span data-feather="bar-chart-2"></span>
                  view all sellers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_view_product.php">
                  <span data-feather="layers"></span>
                  View all products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_product.php">
                  <span data-feather="layers"></span>
                  Add new product/category
                </a>
              </li>
            </ul>

            
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="process/admin_logout_process.php" id="logout">
                  <span data-feather="file-text"></span>
                  Logout
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_view_reviews.php">
                  <span data-feather="file-text"></span>
                  view reviews
                </a>
              </li>
              
            </ul>
          </div>
        </nav>

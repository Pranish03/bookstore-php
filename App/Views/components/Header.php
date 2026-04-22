 <header>
     <h1>
         <a href="/">Bookstore</a>
     </h1>

     <form action="/search" method="get">
         <span id="search-icon">
             <i class="fa-solid fa-magnifying-glass"></i>
         </span>
         <input type="text" name="q" placeholder="Search books by title, author or isbn" required />
         <button type="submit" hidden></button>
     </form>

     <nav>
         <?php if (isset($_SESSION['user'])): ?>

             <a href="/orders" id="orders-btn">
                 <i class="fa-solid fa-box-open"></i>
             </a>

             <a href="/cart" id="cart-btn">
                 <i class="fa-solid fa-bag-shopping"></i>
                 <span id="cart-count"><?= $cartCount ?></span>
             </a>

             <span id="profileBtn">
                 <?php if (isset($_SESSION['user']['profile'])): ?>
                     <img src="<?= asset($_SESSION['user']['profile']) ?>" alt="<?= $_SESSION['user']['name'] ?>">
                 <?php else: ?>
                     <i class="fa-regular fa-user"></i>
                 <?php endif; ?>

                 <div id="profileMenu">
                     <div id="profile-info">
                         <?php if (isset($_SESSION['user']['profile'])): ?>
                             <img src="<?= asset($_SESSION['user']['profile']) ?>" alt="<?= $_SESSION['user']['name'] ?>">
                         <?php else: ?>
                             <div id="profile-avatar">
                                 <i class="fa-regular fa-user"></i>
                             </div>
                         <?php endif; ?>
                         <div>
                             <span><?= $_SESSION['user']['name'] ?></span>
                             <span><?= $_SESSION['user']['email'] ?></span>
                         </div>
                     </div>

                     <div id="profile-links">
                         <a href="/profile">Account</a>
                         <?php if ($_SESSION['user']['is_admin']): ?>
                             <a href="/admin">Dashboard</a>
                         <?php endif; ?>
                         <form action="/logout" method="post">
                             <button type="submit">Logout</button>
                         </form>
                     </div>
                 </div>
             </span>

         <?php else: ?>
             <a href="/register">Register</a>
             <a href="/login">Login</a>
         <?php endif; ?>
     </nav>
 </header>
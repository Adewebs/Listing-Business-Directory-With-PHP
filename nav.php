

<nav class="navbar navbar-expand-lg py-2 navbar-light bg-white">
         <div class="container-fluid">
           <a href="index.php"
             >
             <img src="office/uploads/<?php echo basename($row['directory_logo']); ?>" 
     class="card-img-top directory-logo-img" 
     alt="<?php echo $row['directory_logo']; ?>" >

            </a>
           <button
             class="navbar-toggler collapsed"
             type="button"
             data-toggle="collapse"
             data-target="#navbarCollapse"
             aria-controls="navbarCollapse"
             aria-expanded="false"
             aria-label="Toggle navigation"
           >
             <span class="icon-bar top-bar mt-0"></span>
             <span class="icon-bar middle-bar"></span>
             <span class="icon-bar bottom-bar"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarCollapse">
             <ul class="navbar-nav ml-lg-auto">
               <li class="nav-item dropdown">
               <a class="nav-link" href="index.php">
                   Home
                 </a>
              
               </li>

               <li class="nav-item dropdown">
               <a class="nav-link" href="index.php">
                   Contact Us
                 </a>
                 
               </li>
               <li class="nav-item dropdown">
               <a class="nav-link" href="index.php">
                   About Us
                 </a>
                
               </li>
               <li class="nav-item dropdown">
               <a class="nav-link" href="index.php">
                   Directory
                 </a>
                
               </li>
          
               
             <div class="ml-lg-4 d-none d-lg-block">
             
               <a href="request-list.php" class="btn btn-secondary">List A Business</a>
             </div>
           </div>
         </div>
       </nav>
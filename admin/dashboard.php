<?php include('includes/header.php') ?>

<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="rooms.php">
                    <div class="card shadow">
                        <div class="card-header text-center bg-primary"><h5 class="mb-0">Total Rooms</h5></div>
                        <div class="card-body text-center">
                            <?php 
                                $total_rooms = "SELECT * FROM rooms";
                                $total_rooms_run = mysqli_query($con, $total_rooms);
                                $count = mysqli_num_rows($total_rooms_run);
                            ?>
                            <h1 class="text-dark"><?= $count ?></h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="users.php">
                    <div class="card shadow">
                        <div class="card-header text-center bg-primary"><h5 class="mb-0">Total Users</h5></div>
                        <div class="card-body text-center">
                            <?php 
                                $total_users = "SELECT * FROM users";
                                $total_users_run = mysqli_query($con, $total_users);
                                $user_count = mysqli_num_rows($total_users_run);
                            ?>
                            <h1 class="text-dark"><?= $user_count ?></h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="admins.php">
                    <div class="card shadow">
                        <div class="card-header text-center bg-primary"><h5 class="mb-0">Total Admins</h5></div>
                        <div class="card-body text-center">
                            <?php 
                                $total_admin = "SELECT * FROM admins";
                                $total_admin_run = mysqli_query($con, $total_admin);
                                $admin_count = mysqli_num_rows($total_admin_run);
                            ?>
                            <h1 class="text-dark"><?= $admin_count ?></h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>    
    </div>
</section>

<?php include('includes/footer.php') ?>

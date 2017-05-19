<?php include_once "includes/header.php"; ?>

<?php if( !$session->is_signed_in() ) { redirect("login.php"); }; ?>

<?php 
	
	if ( empty( $_GET['id'] ) ) {
		redirect("photos.php");
	}

	$user = User::find_by_id( $_GET['id']  );

	if ( isset( $_POST['update'] ) ) {
		if ( $user ) {
			
			$user->username = $_POST['username'];
			$user->first_name = $_POST['first_name'];
			$user->last_name = $_POST['last_name'];
			$user->password = $_POST['password'];
			
			if ( empty( $_FILES['user_image']['name'] ) ) {
				
				$user->save();

				redirect( "edit_user.php?id={$user->id}" );

			}else{

				$user->set_file( $_FILES['user_image'] );
				$user->upload_photo();
				$user->save();

				redirect( "edit_user.php?id={$user->id}" );

			}
			
		}
	}
	
?>

    <div id="wrapper">

    <!-- Navigation -->
<?php include_once "includes/top_nav.php"; ?>

<?php include_once "includes/sidebar_nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users <small>Subheading</small>
                    </h1>

                    <div class="col-md-6">
                    	<img  class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?> ">
                    </div>
                    
                    <form action="" method="post" enctype="multipart/form-data">

						<div class="col-md-6">
							<div class="form-group">
								<label for="user_image">Profile Photo</label>
	                    		<input type="file" name="user_image" class="form-control">
	                    	</div>
							<div class="form-group">
								<label for="username">Username</label>
	                    		<input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
	                    	</div>
	                    	<div class="form-group">
	                    	</div>
	                    	<div class="form-group">
	                    		<label for="first_name">First Name</label>
	                    		<input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
	                    	</div>
	                    	<div class="form-group">
	                    		<label for="last_name">Last Name</label>
	                    		<input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
	                    	</div>
	                    	<div class="form-group">
	                    		<label for="password">Password</label>
	                    		<input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
	                    	</div>
	                    	<div class="form-group">
	                    		<a class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
	                    		<input type="submit" name="update" value="Submit" class="btn btn-primary pull-right">
	                    	</div>
	                    </div>

                    </form>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

<?php include_once "includes/footer.php"; ?>